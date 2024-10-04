<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseVideoRequest;
use App\Models\Course;
use App\Models\CourseVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseVideoController extends Controller
{
    public function create(Course $course)
    {
        return view('admin.course_videos.create', compact('course'));
    }

    public function store(StoreCourseVideoRequest $request, Course $course)
    {
        DB::transaction(function () use ($request, $course){

            $validated = $request->validated();

            $validated['course_id'] = $course->id;

            $courseVideo = CourseVideo::create($validated);
        });

        return redirect()->route('admin.courses.show', $course->id)
            ->with('success', 'Course video added successfully.');
    }

    public function edit(CourseVideo $courseVideo)
    {
        return view('admin.course_videos.edit', compact('courseVideo'));
    }

    public function update(StoreCourseVideoRequest $request, CourseVideo $courseVideo)
    {
        DB::transaction(function () use ($request, $courseVideo){

            $validated = $request->validated();

            $courseVideo->update($validated);
        });

        return redirect()->route('admin.courses.show', $courseVideo->course_id)
            ->with('success', 'Course video updated successfully.');
    }

    public function destroy(CourseVideo $courseVideo)
    {
        DB::beginTransaction();

        try {
            $courseVideo->delete();
            DB::commit();

            return redirect()->route('admin.courses.show', $courseVideo->course_id)->with('success', 'Course video deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.courses.show', $courseVideo->course_id)->with('error', 'terjadinya sebuah error');
        }
    }
}
