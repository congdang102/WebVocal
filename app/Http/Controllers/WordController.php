<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Word;

use Illuminate\Http\Request;

class WordController extends Controller
{
    //
    // Hiển thị danh sách từ phân trang.
    public function index()
    {
        $words = Word::orderBy('created_at', 'ASC')->paginate(10); 
    
        return view('admin.words.index', compact('words'));
    }
    
  
    /**
     * Hiển thị biểu mẫu để tạo mới một nguồn dữ liệu.
     */
    public function create()
    {
        // Lấy danh sách chủ đề để hiển thị trong menu dropdown.
        $topics = Topic::orderBy('created_at', 'ASC')->get();
        return view('admin.words.create', compact('topics'));
    }
  
    /**
     * Lưu một nguồn dữ liệu mới vào kho lưu trữ.
     */
    public function store(Request $request)
    {
       
        $filename = '';
        // Kiểm tra xem có tệp ảnh được tải lên không.
        if($request->hasFile('Image')) {
            // Đặt tên tệp và di chuyển tệp đã tải lên vào thư mục public.
            $filename = $request->getSchemeAndHttpHost().'/storage/Word/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/Word/'), $filename);
        }

        // Tạo một từ mới với dữ liệu được cung cấp.
        $words = Word::create([
            'TopicID'=> $request->TopicID,
            'EnglishMeaning' => $request->EnglishMeaning,
            'VietNamMeaning' => $request->VietNamMeaning,
            'Image'=>$filename,
        ]);

        // Chuyển hướng đến trang index với thông báo thành công.
        return redirect()->route('admin.words.index')->with('success', 'Từ đã được thêm thành công');
    }
  
    /**
     * Hiển thị nguồn dữ liệu được chỉ định.
     */
    // public function show(string $id)
    // {
    //     // Tìm và hiển thị chi tiết của một từ cụ thể.
    //     $word = Word::findOrFail($id);
  
    //     return view('admin.words.show', compact('word'));
    // }
  
    /**
     * Hiển thị biểu mẫu để chỉnh sửa nguồn dữ liệu được chỉ định.
     */
    public function edit(string $id)
    {
        // Tìm từ và lấy danh sách chủ đề để hiển thị trong menu dropdown trong biểu mẫu chỉnh sửa.
        $word = Word::findOrFail($id);
        $topics = Topic::orderBy('created_at', 'ASC')->get();
        return view('admin.words.edit', compact('word','topics'));
    }
  
    /**
     * Cập nhật nguồn dữ liệu được chỉ định trong kho lưu trữ.
     */
    public function update(Request $request, string $id)
    {
        // Tìm từ cần cập nhật.
        $word = Word::findOrFail($id);
        
        // Kiểm tra xem có tệp ảnh mới được tải lên không.
        if($request->hasFile('Image')) {
            // Đặt tên tệp và di chuyển tệp đã tải lên vào thư mục public.
            $filename = $request->getSchemeAndHttpHost().'/storage/Word/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/Word/'), $filename);

            // Xóa tệp ảnh cũ nếu có.
            if ($word->Image) {
                $oldImagePath = public_path(str_replace($request->getSchemeAndHttpHost(), '', $word->Image));
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $word->Image = $filename;
        }

        // Cập nhật các trường khác của từ.
        $word->TopicID = $request->TopicID;
        $word->EnglishMeaning = $request->EnglishMeaning;
        $word->VietNamMeaning = $request->VietNamMeaning;
        
        // Lưu cập nhật vào cơ sở dữ liệu.
        $word->save();
  
        // Chuyển hướng đến trang index với thông báo thành công.
        return redirect()->route('admin.words.index')->with('success', 'Từ đã được cập nhật thành công');
    }
  
    /**
     * Xóa nguồn dữ liệu được chỉ định khỏi kho lưu trữ.
     */
    public function destroy(string $id)
    {
        // Tìm và xóa từ được chỉ định.
        $word = Word::findOrFail($id);
        $word->delete();
    
        // Chuyển hướng đến trang index với thông báo thành công.
        return redirect()->route('admin.words.index')->with('success', 'Từ đã được xóa thành công');
    }
}
