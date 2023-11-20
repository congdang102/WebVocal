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
        $words = Word::get();
        $folders = Folder::get();
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();
        return view('search',compact('words', 'userId','folders'));
    }
}
