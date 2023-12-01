<?php

namespace App\Http\Controllers;
use App\Models\History;
use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class StasticController extends Controller
{
    //
    public function statistics(Request $request) {
        // Lấy danh sách từ bảng 'words'
        $words = Word::get();
        
        // Lấy ID của người dùng hiện tại đã đăng nhập
        $userId = Auth::id();
        
        // Lấy tất cả các bản ghi từ bảng 'histories'
        $histories = History::get();
        
        // Trả về view 'statistics' với dữ liệu được chuyển đi
        return view('statistics', compact('words', 'userId', 'histories'));
    }
}

