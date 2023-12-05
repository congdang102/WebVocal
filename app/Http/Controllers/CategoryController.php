<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   // Phương thức hiển thị danh sách các danh mục
   public function index()
   {
    // Lấy danh sách các danh mục sắp xếp theo thời gian tạo và phân trang với 10 mục trên mỗi trang
       $categories = Category::orderBy('created_at', 'ASC')->paginate(10);
        // Trả về view 'admin.categories.index' với dữ liệu danh sách danh mục
       return view('admin.categories.index', compact('categories'));
      
   }
   
   /**
    * Hiển thị form để tạo mới một danh mục.
    */
   public function create()
   {
    // Trả về view để hiển thị form tạo mới danh mục
       return view('admin.categories.create');
       
   }
 
   /**
    * Lưu một danh mục mới vào cơ sở dữ liệu.
    */
   public function store(Request $request)
   {
    // Tạo mới một danh mục dựa trên dữ liệu từ request
       Category::create($request->all());
       // Chuyển hướng về trang danh sách danh mục với thông báo thành công
       return redirect()->route('admin.categories.index')->with('success', 'Danh mục được thêm thành công');
       
   }
 
   /**
    * Hiển thị thông tin chi tiết của một danh mục.
    */
//    public function show(string $id)
//    {
//        $category = Category::findOrFail($id);
//        // Tìm kiếm và lấy thông tin của một danh mục theo ID
//        return view('admin.categories.show', compact('category'));
//        // Trả về view 'admin.categories.show' với dữ liệu của danh mục cần hiển thị
//    }
 
   /**
    * Hiển thị form để chỉnh sửa thông tin của một danh mục.
    */
   public function edit(string $id)
   {
    // Tìm kiếm và lấy thông tin của một danh mục theo ID để hiển thị trong form chỉnh sửa
       $category = Category::findOrFail($id);
       // Trả về view 'admin.categories.edit' với dữ liệu của danh mục cần chỉnh sửa
       return view('admin.categories.edit', compact('category'));
       
   }
 
   /**
    * Cập nhật thông tin của một danh mục trong cơ sở dữ liệu.
    */
   public function update(Request $request, string $id)
   {

       $category = Category::findOrFail($id);
       // Cập nhật thông tin của một danh mục dựa trên dữ liệu từ request
       $category->update($request->all());
        // Chuyển hướng về trang danh sách danh mục với thông báo thành công
       return redirect()->route('admin.categories.index')->with('success', 'Danh mục được cập nhật thành công');
      
   }
 
   /**
    * Xóa một danh mục khỏi cơ sở dữ liệu.
    */
   public function destroy(string $id)
   {
       $category = Category::findOrFail($id);
        // Xóa một danh mục khỏi cơ sở dữ liệu
       $category->delete();
      // Chuyển hướng về trang danh sách danh mục với thông báo thành công
       return redirect()->route('admin.categories.index')->with('success', 'Danh mục được xóa thành công');
       
   }
   
}
