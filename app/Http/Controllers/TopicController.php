<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Topic;
use App\Models\SubTopic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //
    public function index()
    {
        // Lấy danh sách các chủ đề từ cơ sở dữ liệu và phân trang chúng
        $topics = Topic::orderBy('created_at', 'ASC')->paginate(10); // Thay $category thành $topics
    
        // Trả về view 'admin.topics.index' với danh sách chủ đề
        return view('admin.topics.index', compact('topics'));
    }
    
    /**
     * Hiển thị form để tạo chủ đề mới.
     */
    public function create()
    {
        // Lấy danh sách các danh mục con để hiển thị trong form tạo mới
        $subcategories = SubCategory::orderBy('created_at', 'ASC')->get();
        return view('admin.topics.create', compact('subcategories'));
    }
  
    /**
     * Lưu chủ đề mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Xử lý và lưu hình ảnh nếu được tải lên
        $filename = '';
        if($request->hasFile('Image')) {
            $filename = $request->getSchemeAndHttpHost().'/storage/Topic/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/Topic/'), $filename);
        }

        // Tạo mới một chủ đề trong cơ sở dữ liệu
        $topics = Topic::create([
            'SubCategoryID'=> $request->SubCategoryID,
            'TopicName' => $request->TopicName,
            'Image'=>$filename,
        ]);

        // Chuyển hướng về trang danh sách chủ đề với thông báo thành công
        return redirect()->route('admin.topics.index')->with('success', 'Topic added successfully');
    }
  
    /**
     * Hiển thị thông tin chi tiết của chủ đề.
     */
    public function show(string $id)
    {
        // Lấy thông tin chi tiết của chủ đề dựa trên ID
        $topic = Topic::findOrFail($id);
  
        // Trả về view 'admin.topics.show' với thông tin chi tiết của chủ đề
        return view('admin.topics.show', compact('topic'));
    }
  
    /**
     * Hiển thị form để chỉnh sửa thông tin của chủ đề.
     */
    public function edit(string $id)
    {
        // Lấy thông tin chi tiết của chủ đề và danh sách danh mục con
        $topic = Topic::findOrFail($id);
        $subcategories = SubCategory::orderBy('created_at', 'ASC')->get();
        
        // Trả về view 'admin.topics.edit' với thông tin chi tiết và danh sách danh mục con
        return view('admin.topics.edit', compact('subcategories','topic'));
    }
  
    /**
     * Cập nhật thông tin của chủ đề trong cơ sở dữ liệu.
     */
    public function update(Request $request, string $id)
    {
        // Lấy thông tin chi tiết của chủ đề dựa trên ID
        $topic = Topic::findOrFail($id);

        // Kiểm tra nếu có hình ảnh mới được tải lên
        if ($request->hasFile('Image')) {
            $filename = $request->getSchemeAndHttpHost() . '/storage/Topic/' . time() . '.' . $request->Image->extension();
            $request->Image->move(public_path('/storage/Topic/'), $filename);

            // Xóa hình ảnh cũ nếu tồn tại
            if ($topic->Image) {
                $oldImagePath = public_path(str_replace($request->getSchemeAndHttpHost(), '', $topic->Image));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Cập nhật trường Image với tên file hình ảnh mới
            $topic->Image = $filename;
        }

        // Cập nhật các trường thông tin khác
        $topic->SubCategoryID = $request->SubCategoryID;
        $topic->TopicName = $request->TopicName;

        // Lưu các thay đổi vào cơ sở dữ liệu
        $topic->save();

        // Chuyển hướng về trang danh sách chủ đề với thông báo thành công
        return redirect()->route('admin.topics.index')->with('success', 'Topic updated successfully');
    }

    /**
     * Xóa chủ đề khỏi cơ sở dữ liệu.
     */
    public function destroy(string $id)
    {
        // Lấy thông tin chi tiết của chủ đề dựa trên ID
        $topic = Topic::findOrFail($id);
        
        // Xóa chủ đề
        $topic->delete();
    
        // Chuyển hướng về trang danh sách chủ đề với thông báo thành công
        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully');
    }
}
