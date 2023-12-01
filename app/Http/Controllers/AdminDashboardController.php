<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Topic;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        // Lấy tất cả các danh mục
        $categories = Category::all();
        
        // Lấy tất cả các danh mục con
        $subcategories = SubCategory::all();
        
        // Lấy tất cả người dùng
        $users = User::all();
        
        // Lấy tất cả các chủ đề
        $topics = Topic::all();
        
        // Lấy tất cả các từ vựng
        $words = Word::all();
        
        // Trả về view 'admin.adminhome' với các dữ liệu được chuyển giao
        return view('admin.adminhome', compact('categories', 'subcategories', 'users', 'topics', 'words'));
    }   
}

