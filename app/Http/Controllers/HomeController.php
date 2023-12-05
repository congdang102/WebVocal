<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Folder;
use App\Models\Word;
use App\Models\SubCategory;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index() {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if(Auth::id()) {
            // Lấy loại người dùng (user/admin)
            $usertype = Auth()->user()->usertype;

            // Lấy danh sách các danh mục, danh mục con, chủ đề, từ vựng, người dùng, và lịch sử
            $categories = Category::get();
            $subcategories = SubCategory::get();
            $topics = Topic::get();
            $words = Word::get();
            $users = User::get();
            $histories = History::get();

            // Kiểm tra loại người dùng để chuyển hướng đúng view
            if($usertype == 'user') {
                return view('home', compact('categories','subcategories','topics','words','histories'));
            } else if($usertype == 'admin') {
                return view('admin.adminhome',compact('users','categories','subcategories','topics','words','histories'));
            } else {
                return redirect()->back();
            }
        }
    }

    // Hiển thị trang danh sách chủ đề theo danh mục con
    public function showSubCategory(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $topics = Topic::get();
        $words = Word::get();
        $histories = History::get();

        return view('subcategory', compact('subcategory', 'topics','words','histories'));
    }

    // Hiển thị trang chi tiết chủ đề
    public function showTopic(string $id)
    {
        $topic = Topic::findOrFail($id);
        $subcategories = SubCategory::get();
        $words = Word::get();
        $histories = History::get();
        $folders = Folder::get();
        $userId = Auth::id();
        return view('topic', compact('topic','words','subcategories', 'userId','histories','folders'));
    }

    // Hiển thị trang flashcard theo chủ đề
    public function showFlashCard(string $id) {
        $topic = Topic::findOrFail($id);
        $words = Word::get();
        $histories = History::get();
        $userId = Auth::id();

        return view('flashcard', compact('topic', 'words', 'userId','histories'));
    }

    // Hiển thị trang review theo chủ đề
    public function showReview(string $id) {
        $topic = Topic::findOrFail($id);
        $words = Word::get();
        $histories = History::get();
        $userId = Auth::id();

        return view('review', compact('topic', 'words', 'userId','histories'));
    }
}