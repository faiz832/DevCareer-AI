<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $query = Course::with(['category', 'teacher', 'students'])->orderByDesc('id');

        if ($user->hasRole('teacher')) {
            $query->whereHas('teacher', function ($query) use ($user){
                $query->where('user_id', $user->id);
            });
        }

        $courses = $query->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        if (!$teacher) {
            return redirect()->route('admin.courses.index')->withErrors('Unauthorized or invalid teacher.');
        }

        DB::transaction(function () use ($request, $teacher){

            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }else {
                $thumbnailPath = 'images/thumbnail-default.png';
            }

            $validated['slug'] = Str::slug($validated['name']);

            $validated['teacher_id'] = $teacher->id;

            $course = Course::create($validated);

            // Log activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($course)
                ->withProperties(['attributes' => $course->toArray()])
                ->log('Course created');

        });

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        DB::transaction(function () use ($request, $course){

            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $oldAttributes = $course->getAttributes();
            $course->update($validated);

            // Log activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($course)
                ->withProperties([
                    'old' => $oldAttributes,
                    'attributes' => $course->getAttributes()
                ])
                ->log('Course updated');

        });

        return redirect()->route('admin.courses.show', $course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        DB::beginTransaction();

        try {
            $course->delete();

            // Log activity
            activity()
                ->causedBy(Auth::user())
                ->performedOn($course)
                ->log('Course deleted');

            DB::commit();

            return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.courses.index')->with('error', 'An error occurred while deleting the course');
        }
    }
}
