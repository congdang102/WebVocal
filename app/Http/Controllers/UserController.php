<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get(); // Thay $user thành $users
    
        return view('admin.users.index', compact('users'));
    }
    
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());
 
        return redirect()->route('users')->with('success', 'User added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
  
        return view('admin.users.show', compact('user'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
  
        return view('admin.users.edit', compact('user'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
  
        $user->update($request->all());
  
        return redirect()->route('users')->with('success', 'user updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
    
        // Lấy ID của user bị xóa
        $deletedUserId = $user->id;
    
        // Xóa user
        $user->delete();
    
        // Cập nhật IDs cho tất cả user có ID lớn hơn user bị xóa
        User::where('id', '>', $deletedUserId)->decrement('id');
    
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
    
   
}
