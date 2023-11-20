<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::orderBy('created_at', 'ASC')->paginate(10); // Phân trang với 10 mục trên mỗi trang
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
        Category::create($request->all());
 
        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
  
        return view('admin.categories.show', compact('category'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
  
        return view('admin.categories.edit', compact('category'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
  
        $category->update($request->all());
  
        return redirect()->route('admin.categories.index')->with('success', 'category updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
    
        // Lấy ID của category bị xóa
        $deletedCategoryId = $category->CategoryID;
    
        // Xóa category
        $category->delete();
    
        // Cập nhật IDs cho tất cả category có ID lớn hơn category bị xóa
        // Category::where('CategoryID', '>', $deletedCategoryId)->increment('CategoryID');
    
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
    
   
}
