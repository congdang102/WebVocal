<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    public function index()
    {
        $subcategories = SubCategory::orderBy('created_at', 'ASC')->paginate(10); // Thay $category thành $subcategories
    
        return view('admin.subcategories.index', compact('subcategories'));
    }
    
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('created_at', 'ASC')->get();
        return view('admin.subcategories.create', compact('categories'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $filename = '';
        if($request ->hasFile('Image')) {
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
  
        return view('admin.subcategories.show', compact('subcategory'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::orderBy('created_at', 'ASC')->get();
        return view('admin.subcategories.edit', compact('subcategory','categories'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        
        $filename = '';
        if($request ->hasFile('Image')) {
            $filename = $request->getSchemeAndHttpHost().'/storage/SubCategory/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/SubCategory/'), $filename);
        }

        // Kiểm tra nếu có tệp ảnh mới được tải lên
        // Cập nhật các trường khác của SubCategory
        $subcategory->CategoryID = $request->CategoryID;
        $subcategory->SubCategoryName = $request->SubCategoryName;
        $subcategory->Image = $filename;
    
        // Lưu cập nhật vào cơ sở dữ liệu
        $subcategory->save();
  
        return redirect()->route('admin.subcategories.index')->with('success', 'subcategory updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
    
        // Lấy ID của category bị xóa
        $deletedCategoryId = $subcategory->SubCategoryID;
    
        // Xóa category
        $subcategory->delete();
    
        // Cập nhật IDs cho tất cả category có ID lớn hơn category bị xóa
        // SubCategory::where('SubCategoryID', '>', $deletedCategoryId)->increment('SubCategoryID');
    
        return redirect()->route('admin.subcategories.index')->with('success', 'SubCategory deleted successfully');
    }
    
}
