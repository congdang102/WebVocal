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
        // Nhận thông tin từ request
        $wordId = $request->input('wordId');
        $userId = $request->input('userId');

        // Kiểm tra xem từ vựng với WordID đã cho đã được người dùng lưu trữ trước đó chưa
        $existingFolder = FolderHistory::where('WordID', $wordId)
            ->where('UserID', $userId)
            ->first();

        if (!$existingFolder) {
            // Nếu từ vựng chưa được lưu trữ bởi người dùng, thực hiện lưu trữ
            FolderHistory::create([
                'WordID' => $wordId,
                'UserID' => $userId,
            ]);

            // Lưu thêm vào bảng History
            History::create([
                'WordID' => $wordId,
                'UserID' => $userId,
            ]);

            return response()->json(['message' => 'Lịch sử đã được lưu thành công']);
        } else {
            // Nếu từ vựng đã được lưu trữ bởi người dùng, trả về thông báo tương ứng
            return response()->json(['message' => 'Từ vựng đã tồn tại trong lịch sử']);
        }
    }
}
