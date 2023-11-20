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
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $users = User::all();
        $topics = Topic::all();
        $words = Word::all();
        return view('admin.adminhome', compact('categories','subcategories','users','topics','words'));
    }
    
    
   
}
