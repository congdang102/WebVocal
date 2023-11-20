<?php

namespace App\Http\Controllers;
use App\Models\Folder;
use App\Models\FolderHistory;
use App\Models\Topic;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showFolder()
    {
        $words = Word::get();
        $folders = Folder::get();
        $folderhistories = FolderHistory::get();
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();
    
        return view('folder', compact('words', 'userId','folders','folderhistories'));
    }

    public function showFlashCard() {
        // $topic = Topic::findOrFail($id);
        $words = Word::get();
        $folders = Folder::get();
        $folderhistories = FolderHistory::get();
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();
    
        return view('folderflashcard', compact('words', 'userId','folders','folderhistories'));
    }
    public function showReview() {
        // $topic = Topic::findOrFail($id);
        $words = Word::get();
        $folders = Folder::get();
        $folderhistories = FolderHistory::get();
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();
    
        return view('folderreview', compact('words', 'userId','folders','folderhistories'));
    }
    public function store(Request $request)
    {
        $wordId = $request->input('wordId');
        $userId = $request->input('userId');
    
        // Check if the word with the given WordID has already been saved by the user
        $existingFolder = Folder::where('WordID', $wordId)
            ->where('UserID', $userId)
            ->first();
    
        if (!$existingFolder) {
            // The word hasn't been saved by the user, so save it
            Folder::create([
                'WordID' => $wordId,
                'UserID' => $userId,
            ]);
    
            return response()->json(['message' => 'History saved successfully']);
        } else {
            // The word has already been saved by the user, return a response indicating that
            return response()->json(['message' => 'Word already exists in history']);
        }
    }
    public function destroy(string $id)
    {
        $folder = Folder::findOrFail($id);
    
        // Lấy ID của category bị xóa
        // $deletedFolderId = $folder->FolderID;
    
        // Xóa category
        $folder->delete();
    
        // Cập nhật IDs cho tất cả category có ID lớn hơn category bị xóa
        // Category::where('CategoryID', '>', $deletedCategoryId)->increment('CategoryID');
    
        return redirect()->route('folder')->with('success', 'Word deleted successfully');
    }
}
