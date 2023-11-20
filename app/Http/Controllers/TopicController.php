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
        $topics = Topic::orderBy('created_at', 'ASC')->paginate(10); // Thay $category thành $topics
    
        return view('admin.topics.index', compact('topics'));
    }
    
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = SubCategory::orderBy('created_at', 'ASC')->get();
        return view('admin.topics.create', compact('subcategories'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $filename = '';
        if($request ->hasFile('Image')) {
            $filename = $request->getSchemeAndHttpHost().'/storage/Topic/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/Topic/'), $filename);
        }

        $topics = Topic::create([
            'SubCategoryID'=> $request->SubCategoryID,
            'TopicName' => $request->TopicName,
            'Image'=>$filename,

        ]);
        return redirect()->route('admin.topics.index')->with('success', 'Topic added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::findOrFail($id);
  
        return view('admin.topics.show', compact('topic'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $topic = Topic::findOrFail($id);
        $subcategories = SubCategory::orderBy('created_at', 'ASC')->get();
        return view('admin.topics.edit', compact('subcategories','topic'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $topic = Topic::findOrFail($id);
        
        $filename = '';
        if($request ->hasFile('Image')) {
            $filename = $request->getSchemeAndHttpHost().'/storage/Topic/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/Topic/'), $filename);
        }

        // Kiểm tra nếu có tệp ảnh mới được tải lên
        // Cập nhật các trường khác của Topic
        $topic->SubCategoryID = $request->SubCategoryID;
        $topic->TopicName = $request->TopicName;
        $topic->Image = $filename;
    
        // Lưu cập nhật vào cơ sở dữ liệu
        $topic->save();
  
        return redirect()->route('admin.topics.index')->with('success', 'topic updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $topic = Topic::findOrFail($id);
    
        // Lấy ID của category bị xóa
        $deletedTopicId = $topic->TopicID;
    
        // Xóa category
        $topic->delete();
    
        // Cập nhật IDs cho tất cả category có ID lớn hơn category bị xóa
        // Topic::where('TopicID', '>', $deletedTopicId)->increment('TopicID');
    
        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully');
    }
    
}
