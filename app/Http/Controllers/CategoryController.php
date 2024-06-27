<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('categories.index', compact('categories'));
  }

  public function create()
  {
    return view('categories.create');
  }

  public function store(CategoryRequest $request)
  {
    Category::create($request->validated());
    return redirect()->route('categories.index');
  }

  public function show(Category $category)
  {
    //
  }

  public function edit(Category $category)
  {
    return view('categories.edit', compact('category'));
  }

  public function update(CategoryRequest $request, Category $category)
  {
    $category->update($request->validated());
    return redirect()->route('categories.index');
  }

  public function destroy(Category $category)
  {
    $category->delete();
    return redirect()->route('categories.index');
  }
}
