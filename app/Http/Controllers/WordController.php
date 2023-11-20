<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Word;
use App\Models\SubTopic;
use Illuminate\Http\Request;

class WordController extends Controller
{
    //
    public function index()
    {
        $words = Word::orderBy('created_at', 'ASC')->paginate(10); // Thay $category thành $words
    
        return view('admin.words.index', compact('words'));
    }
    
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $topics = Topic::orderBy('created_at', 'ASC')->get();
        return view('admin.words.create', compact('topics'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $filename = '';
        if($request ->hasFile('Image')) {
            $filename = $request->getSchemeAndHttpHost().'/storage/Word/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/Word/'), $filename);
        }

        $words = Word::create([
            'TopicID'=> $request->TopicID,
            'EnglishMeaning' => $request->EnglishMeaning,
            'VietNamMeaning' => $request->VietNamMeaning,
            'Image'=>$filename,

        ]);
        return redirect()->route('admin.words.index')->with('success', 'Topic added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $word = Word::findOrFail($id);
  
        return view('admin.words.show', compact('word'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $word = Word::findOrFail($id);
        $topics = Topic::orderBy('created_at', 'ASC')->get();
        return view('admin.words.edit', compact('word','topics'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $word = Word::findOrFail($id);
        
        $filename = '';
        if($request ->hasFile('Image')) {
            $filename = $request->getSchemeAndHttpHost().'/storage/Word/'.time() .'.'. $request->Image->extension();
            $request->Image->move(public_path('/storage/Word/'), $filename);
        }

        // Kiểm tra nếu có tệp ảnh mới được tải lên
        // Cập nhật các trường khác của Topic
        $word->TopicID = $request->TopicID;
        $word->EnglishMeaning = $request->EnglishMeaning;
        $word->VietNamMeaning = $request->VietNamMeaning;
        $word->Image = $filename;
    
        // Lưu cập nhật vào cơ sở dữ liệu
        $word->save();
  
        return redirect()->route('admin.words.index')->with('success', 'word updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $word = Word::findOrFail($id);
    
        // Lấy ID của category bị xóa
        $deletedWordId = $word->WordID;
    
        // Xóa category
        $word->delete();
    
        // Cập nhật IDs cho tất cả category có ID lớn hơn category bị xóa
        // Word::where('WordID', '>', $deletedWordId)->increment('WordID');
    
        return redirect()->route('admin.words.index')->with('success', 'Word deleted successfully');
    }
    
}
