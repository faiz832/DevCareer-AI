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
        $teacherCount = User::role('teacher')->count();
        $studentCount = User::role('student')->count();
        $courseCount = Course::count();
        $revenueTotal = SubscribeTransaction::where('is_paid', true)->sum('total_amount');

        $activities = Activity::with('causer', 'subject')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('teacherCount', 'studentCount', 'courseCount', 'revenueTotal', 'activities'));
    }
}
