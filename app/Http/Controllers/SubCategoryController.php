<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    // Hiển thị danh sách các SubCategory được phân trang
    public function index()
    {
        $subcategories = SubCategory::orderBy('created_at', 'ASC')->paginate(10); // Thay $category thành $subcategories
    
        return view('admin.subcategories.index', compact('subcategories'));
    }
    
    /**
     * Hiển thị form để tạo mới một resource.
     */
    public function create()
    {
        // Lấy danh sách các categories để hiển thị trong dropdown ở form tạo mới
        $categories = Category::orderBy('created_at', 'ASC')->get();
        return view('admin.subcategories.create', compact('categories'));
    }
  
    /**
     * Lưu một resource mới vào storage.
     */
    public function store(Request $request)
    {
        // Xử lý upload hình ảnh và lưu dữ liệu của SubCategory
        $filename = '';
        if($request->hasFile('Image')) {
            $filename = $request->getSchemeAndHttpHost().'/storage/SubCategory/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/SubCategory/'), $filename);
        }

        $subcategories = SubCategory::create([
            'CategoryID'=> $request->CategoryID,
            'SubCategoryName' => $request->SubCategoryName,
            'Image'=>$filename,
        ]);
        
        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory added successfully');
    }
  
    /**
     * Hiển thị thông tin của resource cụ thể.
     */
    public function show(string $id)
    {
        // Lấy và hiển thị thông tin chi tiết của một SubCategory cụ thể
        $subcategory = SubCategory::findOrFail($id);
        return view('admin.subcategories.show', compact('subcategory'));
    }
  
    /**
     * Hiển thị form để chỉnh sửa resource cụ thể.
     */
    public function edit(string $id)
    {
        // Lấy thông tin của SubCategory và danh sách categories để hiển thị trong dropdown ở form chỉnh sửa
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::orderBy('created_at', 'ASC')->get();
        return view('admin.subcategories.edit', compact('subcategory','categories'));
    }
  
    /**
     * Cập nhật resource cụ thể trong storage.
     */
    public function update(Request $request, string $id)
    {
        // Cập nhật dữ liệu của SubCategory, xử lý upload hình ảnh, và xóa hình ảnh cũ nếu có
        $subcategory = SubCategory::findOrFail($id);

        if ($request->hasFile('Image')) {
            // Xử lý upload hình ảnh mới
            $filename = $request->getSchemeAndHttpHost() . '/storage/SubCategory/' . time() . '.' . $request->Image->extension();
            $request->Image->move(public_path('/storage/SubCategory/'), $filename);

            // Xóa hình ảnh cũ nếu tồn tại
            if ($subcategory->Image) {
                $oldImagePath = public_path(str_replace($request->getSchemeAndHttpHost(), '', $subcategory->Image));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Cập nhật trường Image với tên file hình ảnh mới
            $subcategory->Image = $filename;
        }

        // Cập nhật các trường dữ liệu khác
        $subcategory->CategoryID = $request->CategoryID;
        $subcategory->SubCategoryName = $request->SubCategoryName;

        // Lưu các thay đổi vào cơ sở dữ liệu
        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully');
    }

    /**
     * Xóa resource cụ thể khỏi storage.
     */
    public function destroy(string $id)
    {
        // Xóa một SubCategory
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory deleted successfully');
    }
}
