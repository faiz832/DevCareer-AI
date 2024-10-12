<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseVideoRequest;
use App\Models\Course;
use App\Models\CourseVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            // Log activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($courseVideo)
                ->withProperties(['attributes' => $courseVideo->toArray()])
                ->log('Course video created by ' . Auth::user()->name);
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

            $oldAttributes = $courseVideo->getAttributes();
            $courseVideo->update($validated);

            // Log activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($courseVideo)
                ->withProperties([
                    'old' => $oldAttributes,
                    'attributes' => $courseVideo->getAttributes()
                ])
                ->log('Course video updated');
        });

        return redirect()->route('admin.courses.show', $courseVideo->course_id)
            ->with('success', 'Course video updated successfully.');
    }

    public function destroy(CourseVideo $courseVideo)
    {
        DB::beginTransaction();

        try {
            $courseVideoAttributes = $courseVideo->toArray();
            $courseVideo->delete();

            activity()
                ->causedBy(Auth::user())
                ->performedOn($courseVideo)
                ->withProperties(['attributes' => $courseVideoAttributes])
                ->log('Course video deleted');

            DB::commit();

            return redirect()->route('admin.courses.show', $courseVideo->course_id)
                ->with('success', 'Course video deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.courses.show', $courseVideo->course_id)
                ->with('error', 'An error accured while deleting the course video.');
        }
    }
}
