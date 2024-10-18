<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseProgressController extends Controller
{
    // public function markVideoAsWatched(Request $request, Course $course, CourseVideo $video)
    // {
    //     $user = Auth::user();
    //     $courseStudent = CourseStudent::firstOrCreate(
    //         ['user_id' => $user->id, 'course_id' => $course->id]
    //     );

    //     // Increment videos_completed only if it hasn't been watched before
    //     if (!$courseStudent->watchedVideos()->where('course_video_id', $video->id)->exists()) {
    //         $courseStudent->videos_completed += 1;
    //         $courseStudent->watchedVideos()->attach($video->id);

    //         if ($courseStudent->videos_completed == $course->course_videos->count()) {
    //             $courseStudent->is_completed = true;
    //             $courseStudent->completed_at = now();
    //             $this->generateCertificate($courseStudent);
    //         }

    //         $courseStudent->save();
    //     }

    //     return response()->json(['success' => true]);
    // }

    // private function generateCertificate(CourseStudent $courseStudent)
    // {
    //     // Logic to generate PDF certificate
    //     // Save certificate path to $courseStudent->certificate_path
    // }
}
