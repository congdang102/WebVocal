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
        $words = Word::get();
        $userId = Auth::id();
        $histories = History::get();
        return view('statistics',compact('words','userId','histories'));
    }
}
