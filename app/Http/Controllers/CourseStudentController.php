<?php

namespace App\Http\Controllers;

use App\Models\CourseStudent;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Mengambil kursus yang diikuti oleh user yang login
        $courses = $user->courses()->with('teacher', 'category')->get();

        // Mengirim data kursus ke view 'front.mycourses'
        return view('front.mycourses', compact('courses'));
    }

    public function markVideoAsWatched(Request $request, Course $course, CourseVideo $video)
    {
        $user = auth()->user();
        $courseStudent = CourseStudent::firstOrCreate([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $courseStudent->videos_completed++;
        $courseStudent->save();

        if ($courseStudent->videos_completed == $course->course_videos->count()) {
            $courseStudent->is_completed = true;
            $courseStudent->completed_at = now();
            $courseStudent->save();
        }

        return response()->json(['message' => 'Video marked as watched']);
    }

    public function downloadCertificate(Course $course)
    {
        $user = auth()->user();
        $courseStudent = CourseStudent::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($courseStudent && $courseStudent->is_completed) {
            $certificatePath = $this->generateCertificate($user, $course, $courseStudent);
            $courseStudent->certificate_path = $certificatePath;
            $courseStudent->save();

            return response()->download($certificatePath, "{$course->name} - Certificate.pdf");
        }

        return redirect()->back()->with('error', 'You have not completed the course yet.');
    }

    private function generateCertificate($user, $course, $courseStudent)
    {
        $certificatePath = public_path('certificates/' . $user->id . '_' . $course->id . '.pdf');

        $html = view('certificates.course-certificate', [
            'user' => $user,
            'course' => $course,
            'completionDate' => $courseStudent->completed_at,
        ])->render();

        $pdf = \App\Services\PdfService::generateFromHtml($html, $certificatePath);

        return $certificatePath;
    }
}
