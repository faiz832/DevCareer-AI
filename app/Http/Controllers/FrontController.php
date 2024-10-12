<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
