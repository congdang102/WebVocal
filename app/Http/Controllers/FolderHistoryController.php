<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\FolderHistory;
use App\Models\History;

class FolderHistoryController extends Controller
{
    //
    public function store(Request $request)
{
    $wordId = $request->input('wordId');
    $userId = $request->input('userId');

    // Check if the word with the given WordID has already been saved by the user
    $existingFolder = FolderHistory::where('WordID', $wordId)
        ->where('UserID', $userId)
        ->first();

    if (!$existingFolder) {
        // The word hasn't been saved by the user, so save it
        FolderHistory::create([
            'WordID' => $wordId,
            'UserID' => $userId,
        ]);
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
