<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderByDesc('id')->get();

        return view('admin.teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        DB::beginTransaction();
        try {
            $user = User::where('email', $request->email)->firstOrFail();

            if ($user->hasRole('teacher')) {
                return redirect()->back()->with('error', 'User is already a teacher.');
            }

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'is_active' => true,
            ]);

            $user->assignRole('teacher');

            DB::commit();
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while adding the teacher.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        // return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $teacher->update([
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            $user = $teacher->user;
            $user->removeRole('teacher');
            $user->assignRole('student');
            $teacher->delete();

            DB::commit();
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher removed successfully and role changed to student.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while removing the teacher.');
        }
    }

    public function searchStudents(Request $request)
    {
        $query = $request->input('query');
        $students = User::role('student')
            ->where('email', 'LIKE', "%{$query}%")
            ->select('id', 'email')
            ->limit(10)
            ->get();

        return response()->json($students);
    }
}
