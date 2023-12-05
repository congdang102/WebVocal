<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Hiển thị danh sách người dùng.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get(); // Sắp xếp người dùng theo thời gian tạo giảm dần
    
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * Hiển thị form để tạo người dùng mới.
     */
    public function create()
    {
        return view('admin.users.create');
    }
  
    /**
     * Lưu người dùng mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        User::create($request->all());
 
        return redirect()->route('users')->with('success', 'Người dùng đã được thêm thành công');
    }
  
    /**
     * Hiển thị thông tin chi tiết của người dùng.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
  
        return view('admin.users.show', compact('user'));
    }
  
    // /**
    //  * Hiển thị form để chỉnh sửa thông tin của người dùng.
    //  */
    // public function edit(string $id)
    // {
    //     $user = User::findOrFail($id);
  
    //     return view('admin.users.edit', compact('user'));
    // }
  
    // /**
    //  * Cập nhật thông tin của người dùng trong cơ sở dữ liệu.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     $user = User::findOrFail($id);
  
    //     $user->update($request->all());
  
    //     return redirect()->route('users')->with('success', 'Người dùng đã được cập nhật thành công');
    // }
  
    /**
     * Xóa người dùng khỏi cơ sở dữ liệu.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
    
        // Lấy ID của người dùng bị xóa
        $deletedUserId = $user->id;
    
        // Xóa người dùng
        $user->delete();
    
        // Cập nhật IDs cho tất cả người dùng có ID lớn hơn người dùng bị xóa
        User::where('id', '>', $deletedUserId)->decrement('id');
    
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công');
    }
}
