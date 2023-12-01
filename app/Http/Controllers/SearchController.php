<?php

namespace App\Http\Controllers;
use App\Models\Folder;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request) {
        // Lấy tất cả các từ và các từ vựng trong thư mục từ cơ sở dữ liệu
        $words = Word::get();
        $folders = Folder::get();
        
        // Lấy ID của người dùng hiện tại đã đăng nhập
        $userId = Auth::id();
        
        // Trả về view 'search' với dữ liệu (các từ, userId, và thư mục)
        return view('search', compact('words', 'userId', 'folders'));
    }
}
