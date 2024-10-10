<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'teacher', 'students'])
            ->orderByDesc('id');

        $user = Auth::user();

        // Check if user is authenticated and has teacher role
        if ($user && $user->hasRole('teacher')) {
            $courses->whereHas('teacher', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        // Get the final courses collection
        $courses = $courses->take(4)->get();

        $studentCount = $courses->sum(function ($course) {
            return $course->students->count();
        });

        return view('welcome', compact('courses', 'studentCount'));
    }

    public function course()
    {

        $courses = Course::with(['category', 'teacher', 'students'])->orderByDesc('id')->get();

        return view('front.course', compact('courses'));
    }

    public function details(Course $course)
    {
        return view('front.details', compact('course'));
    }

    public function pricing()
    {
        if (Auth::user()->hasActiveSubscription()) {
            return redirect()->route('welcome');
        }
        return view('front.pricing');
    }

    public function checkout()
    {
        if (Auth::user()->hasActiveSubscription()) {
            return redirect()->route('welcome');
        }
        return view('front.checkout');
    }

    public function resume()
    {
        return view('front.resume');
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
