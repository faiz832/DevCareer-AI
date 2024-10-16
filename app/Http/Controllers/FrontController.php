<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\SubscribeTransaction;

class FrontController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'teacher', 'students'])
            ->orderByDesc('id')
            ->take(4)
            ->get();

        $studentCount = $courses->sum(function ($course) {
            return $course->students->count();
        });

        return view('welcome', compact('courses', 'studentCount'));
    }

    public function course()
    {

        $categories = Category::all();
        $coursesByCategory = [];

        foreach ($categories as $category) {
            $coursesByCategory[$category->id] = Course::with(['category', 'teacher', 'students'])
                ->where('category_id', $category->id)
                ->orderByDesc('id')
                ->get();
        }

        $studentCount = collect($coursesByCategory)->flatten()->sum(function ($course) {
            return $course->students->count();
        });

        return view('front.course', compact('categories', 'coursesByCategory', 'studentCount'));
    }

    public function details($id)
    {
        $course = Course::with(['category', 'teacher', 'students', 'course_videos'])
            ->findOrFail($id);

        return view('front.details', compact('course'));
    }

    public function enroll(Course $course)
    {
        $user = Auth::user();

        if (!$user->hasActiveSubscription()) {
            return redirect()->route('front.pricing')->with('error', 'You need to subscribe to enroll in courses.');
        }

        if (!$course->students->contains($user->id)) {
            $course->students()->attach($user->id);
            return redirect()->route('front.details', $course->id)->with('success', 'You have successfully enrolled in this course.');
        }

        return redirect()->route('front.details', $course->id)->with('info', 'You are already enrolled in this course.');
    }

    public function resume()
    {
        return view('front.resume');
    }

    public function pricing()
    {
        // if (Auth::user()->hasActiveSubscription()) {
        //     return redirect()->route('front.index');
        // }
        return view('front.pricing');
    }

    public function checkout()
    {
        // if (Auth::user()->hasActiveSubscription()) {
        //     return redirect()->route('front.index');
        // }
        return view('front.checkout');
    }

    public function checkout_store(StoreSubscribeTransactionRequest $request)
    {
        $user = Auth::user();

        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }

        DB::transaction(function () use ($request, $user) {
            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = 100000;
            $validated['is_paid'] = false;

            $transaction = SubscribeTransaction::create($validated);
        });

        return redirect()->route('dashboard');
    }

    public function faq()
    {
        return view('front.faq');
    }

    public function terms()
    {
        return view('front.terms');
    }

    public function privacy()
    {
        return view('front.privacy');
    }

    public function notfound()
    {
        return view('front.404');
    }
}
