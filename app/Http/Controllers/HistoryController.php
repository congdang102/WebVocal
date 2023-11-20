<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
class HistoryController extends Controller
{
    //
    public function store(Request $request)
{
    $wordId = $request->input('wordId');
    $userId = $request->input('userId');

    // Check if the word with the given WordID has already been saved by the user
    $existingHistory = History::where('WordID', $wordId)
        ->where('UserID', $userId)
        ->first();

    if (!$existingHistory) {
        // The word hasn't been saved by the user, so save it
        History::create([
            'WordID' => $wordId,
            'UserID' => $userId,
        ]);

        return response()->json(['message' => 'History saved successfully']);
    } else {
        // The word has already been saved by the user, return a response indicating that
        return response()->json(['message' => 'Word already exists in history']);
    }
}
}
