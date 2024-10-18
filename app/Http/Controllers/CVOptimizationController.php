<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CVOptimizationController extends Controller
{
    public function index()
    {
        return view('front.resume');
    }

    public function optimize(Request $request)
    {
        $request->validate([
            'cv_file' => 'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        $user = auth()->user(); // Get the authenticated user

        // Check if the user has enough tokens
        if ($user->ai_token < 1) {
            return back()->withErrors('Token is not enough. Please try again.');
        }

        $file = $request->file('cv_file');
        $filePath = $file->getPathname();
        $fileMimeType = $file->getClientMimeType();

        try {
            $fileContent = file_get_contents($filePath);
            $base64FileContent = base64_encode($fileContent);

            $prompt = "Analyze this resume and provide detailed suggestions for optimization. Focus on improving structure, content, and highlighting key skills and achievements.";

            $requestBody = [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ],
                            [
                                'inline_data' => [
                                    'mime_type' => $fileMimeType,
                                    'data' => $base64FileContent
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . env('GOOGLE_API_KEY'), $requestBody);

            if ($response->failed()) {
                Log::error('Google AI API Error: ' . $response->body());
                return back()->withErrors('Failed to optimize CV. Please try again.');
            }

            $data = $response->json();

            // Debugging: Log the entire response
            Log::info('Google AI API Response:', $data);

            // Extract the result text from the response
            $resultText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (!$resultText) {
                Log::warning('No text found in API response');
                return back()->withErrors('No optimization suggestions returned. Please try again.');
            }

            // Reduce the user's token by 1
            $user->ai_token -= 1;
            $user->save();

            $formattedResult = $this->formatResult($resultText);

            return view('front.resume-result', ['optimizedContent' => $formattedResult]);
        } catch (\Exception $e) {
            Log::error('Error processing the file: ' . $e->getMessage());
            return back()->withErrors('Error processing the file. Please try again.');
        }
    }

    private function formatResult(string $text): string
    {
        // Mengganti teks yang menggunakan ## sebagai heading
        $text = preg_replace('/##\s*(.*?)(?=\n)/', '<h2 class="text-xl font-bold m-0">$1</h2>', $text);

        // Mengganti teks yang menggunakan ** sebagai strong
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);

        // Mengganti teks yang menggunakan * sebagai list
        $text = preg_replace('/^\*\s*(.*)$/m', '<li class="m-0">$1</li>', $text);

        // Mengganti newline ganda dengan <br>
        $text = nl2br($text);

        // Menambahkan <ul> di sekitar list
        $text = preg_replace('/(<li>.*?<\/li>)/s', '<ul class="m-0">$0</ul>', $text);

        // Mengganti paragraf dengan <p>
        $paragraphs = explode("\n\n", $text);
        $formattedParagraphs = array_map(function ($paragraph) {
            return '<p>' . trim($paragraph) . '</p>';
        }, $paragraphs);

        // Mengembalikan hasil dengan menggabungkan paragraf yang sudah diformat
        return implode("\n", $formattedParagraphs);
    }

}
