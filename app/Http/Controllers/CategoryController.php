<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index', [
            'title' => 'List Kategori',
            'categories' => Category::orderBy('sort_order')->orderBy('name')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create', [
            'title' => 'Tambah Kategori',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateCategory($request);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('categories', 'public');
        }

        $validatedData['slug'] = $validatedData['slug'] ?: Str::slug($validatedData['name']);
        $validatedData['is_active'] = $request->boolean('is_active');
        $validatedData['sort_order'] = (int) ($validatedData['sort_order'] ?? 0);

        Category::create($validatedData);
        return redirect(route('categories.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', [
            'title' => 'Edit Kategori',
            'categories' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $this->validateCategory($request, $category);

        if ($request->hasFile('image')) {
            if ($category->image && !Str::startsWith($category->image, ['http://', 'https://', 'landing/', 'img/', 'assets/'])) {
                Storage::disk('public')->delete($category->image);
            }

            $validatedData['image'] = $request->file('image')->store('categories', 'public');
        }

        $validatedData['slug'] = $validatedData['slug'] ?: Str::slug($validatedData['name']);
        $validatedData['is_active'] = $request->boolean('is_active');
        $validatedData['sort_order'] = (int) ($validatedData['sort_order'] ?? 0);

        Category::where('id', $category->id)->update($validatedData);
        return redirect(route('categories.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->image && !Str::startsWith($category->image, ['http://', 'https://', 'landing/', 'img/', 'assets/'])) {
            Storage::disk('public')->delete($category->image);
        }

        Category::destroy($category->id);
        return redirect(route('categories.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }

    protected function validateCategory(Request $request, Category $category = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . optional($category)->id,
            'description' => 'nullable|string',
            'landing_summary' => 'nullable|string',
            'detail_route' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);
    }
}
