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
        // Lấy giá trị của wordId và userId từ request
        $wordId = $request->input('wordId');
        $userId = $request->input('userId');

        // Kiểm tra xem có Folder nào tồn tại với WordID và UserID tương ứng không
        $existingFolder = Folder::where('WordID', $wordId)
            ->where('UserID', $userId)
            ->first();

        // Nếu Folder chưa tồn tại, tạo mới và lưu vào cơ sở dữ liệu
        if (!$existingFolder) {
            Folder::create([
                'WordID' => $wordId,
                'UserID' => $userId,
            ]);

            // Trả về thông báo JSON nếu lưu thành công
            return response()->json(['message' => 'Lịch sử đã được lưu thành công']);
        } else {
            // Nếu từ đã được người dùng lưu trước đó, trả về thông báo JSON
            return response()->json(['message' => 'Từ đã tồn tại trong lịch sử']);
        }
    }

    public function destroy(string $id)
    {
        // Tìm kiếm và lấy thông tin từ vựng trong thư mục dựa trên ID
        $folder = Folder::findOrFail($id);

        // Xóa thư mục khỏi cơ sở dữ liệu
        $folder->delete();
        
        // Chuyển hướng người dùng về trang danh sách thư mục và thông báo xóa thành công
        return redirect()->route('folder')->with('success', 'Thư mục đã được xóa thành công');
    }

}
