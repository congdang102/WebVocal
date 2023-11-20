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
        if(Auth::id()) {
            $usertype=Auth()->user()->usertype;
            $categories = Category::get();
            $subcategories = SubCategory::get();
            $topics = Topic::get();
            $words= Word::get();
            $users = User::get();
            $histories = History::get();
            if($usertype == 'user') {
                return view('home', compact('categories','subcategories','topics','words','histories'));
            }
            else if($usertype == 'admin') {
                return view('admin.adminhome',compact('users','categories','subcategories','topics','words','histories'));
                
            }
            else {
                return redirect()->back();
            }
        }
    }
    public function showSubCategory(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $topics = Topic::get();
        $words = Word::get();
        $histories = History::get();
        return view('subcategory', compact('subcategory', 'topics','words','histories'));
    }

    public function showTopic(string $id)
    {
        $topic = Topic::findOrFail($id);
        $subcategories = SubCategory::get();
        // Bây giờ bạn có thể sử dụng $this->subcategory ở đây
       $words = Word::get();
       $histories = History::get();
       $folders = Folder::get();
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();
        return view('topic', compact('topic','words','subcategories', 'userId','histories','folders'));
    }
    public function showFlashCard(string $id) {
        $topic = Topic::findOrFail($id);
        $words = Word::get();
        $histories = History::get();
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();
    
        return view('flashcard', compact('topic', 'words', 'userId','histories'));
    }
    public function showReview(string $id) {
        $topic = Topic::findOrFail($id);
        $words = Word::get();
        $histories = History::get();
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();
    
        return view('review', compact('topic', 'words', 'userId','histories'));
    }
    
   
    //
}
