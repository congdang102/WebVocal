<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
class HistoryController extends Controller
{
    //
    public function store(Request $request)
    {
        // Lấy giá trị WordID và UserID từ request
        $wordId = $request->input('wordId');
        $userId = $request->input('userId');

        // Kiểm tra xem từ với WordID đã cho có được lưu trữ bởi người dùng hay chưa
        $existingHistory = History::where('WordID', $wordId)
            ->where('UserID', $userId)
            ->first();

        if (!$existingHistory) {
            // Nếu từ chưa được lưu trữ bởi người dùng, thì lưu trữ nó
            History::create([
                'WordID' => $wordId,
                'UserID' => $userId,
            ]);

            return response()->json(['message' => 'Lịch sử đã được lưu trữ thành công']);
        } else {
            // Nếu từ đã được lưu trữ bởi người dùng, trả về một phản hồi cho biết điều đó
            return response()->json(['message' => 'Từ đã tồn tại trong lịch sử']);
        }
    }
}
