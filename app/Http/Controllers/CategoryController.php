<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::orderByDesc('id')->get();

        // ddump, cek dah ada datanya apa belum
        // dd($categories);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            // 'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $iconPath = $request->file('icon')->store('categories', 'public');

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            // 'icon' => $iconPath,
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($category)
            ->log('Category created');

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, Category $category)
     {
         $request->validate([
             'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
             // 'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

        $oldAttributes = $category->getAttributes();

        $category->fill([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        $category->save();

         // if ($request->hasFile('icon')) {
        //     Storage::disk('public')->delete($category->icon);
        //     $data['icon'] = $request->file('icon')->store('categories', 'public');
        // }

        activity()
            ->causedBy(Auth::user())
            ->performedOn($category)
            ->withProperties([
                'old' => $oldAttributes,
                'new' => $category->getAttributes(),
            ])
            ->log('Category updated');

         return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Storage::disk('public')->delete($category->icon);
        if ($category->courses()->exists()) {
            return back()->with('error', 'Cannot delete category with associated courses.');
        }

        $oldAttributes = $category->getAttributes();
        $category->delete();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($category)
            ->withProperties(['old' => $oldAttributes])
            ->log('Category deleted');

        return back()->with('success', 'Category deleted successfully.');
        return redirect()->route('admin.categories.index')->with('success', 'Category permanently deleted successfully.');
    }
}
