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
    
       
        $existingFolder = Folder::where('WordID', $wordId)
            ->where('UserID', $userId)
            ->first();
    
        if (!$existingFolder) {
           
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
    
        $folder->delete();
        
        return redirect()->route('folder')->with('success', 'Word deleted successfully');
    }
}
