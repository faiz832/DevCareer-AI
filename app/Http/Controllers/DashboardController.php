<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use App\Models\Course;
use App\Models\SubscribeTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('owner')) {
            $teacherCount = User::role('teacher')->count();
            $studentCount = User::role('student')->count();
            $courseCount = Course::count();
            $subscriptionCount = SubscribeTransaction::count();
            $subscriptionCount = SubscribeTransaction::where('is_paid', true)->count();
            $revenueTotal = SubscribeTransaction::where('is_paid', true)->sum('total_amount');

            $activities = Activity::with('causer', 'subject')
                ->latest()
                ->get();

            return view('dashboard', compact('teacherCount', 'studentCount', 'courseCount', 'subscriptionCount', 'revenueTotal', 'activities'));
        } elseif (auth()->user()->hasRole('teacher')) {
            $teacher = auth()->user()->teacher;

            if (!$teacher) {
                return view('dashboard', [
                    'courses' => collect(),
                    'totalStudents' => 0,
                    'courseCount' => 0
                ]);
            }

            $courses = $teacher->courses;
            $totalStudents = $courses->sum(function ($course) {
                return $course->students->count();
            });

            return view('dashboard', [
                'courses' => $courses,
                'totalStudents' => $totalStudents,
                'courseCount' => $courses->count()
            ]);
        } elseif (auth()->user()->hasRole('student')) {
            $student = auth()->user();
            $subscription = $student->hasActiveSubscription();
            $courses = $student->courses;

            return view('dashboard', [
                'subscription' => $subscription,
                'courses' => $courses,
                'courseCount' => $courses->count()
            ]);
        }

        // Fallback view jika role tidak dikenali
        return view('dashboard');
    }
}
