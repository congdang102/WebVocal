<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Hiển thị form chỉnh sửa thông tin cá nhân của người dùng.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Cập nhật thông tin cá nhân của người dùng.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Điền thông tin mới vào đối tượng người dùng.
        $request->user()->fill($request->validated());

        // Nếu email thay đổi, đặt lại trạng thái chưa xác nhận email.
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Lưu thông tin người dùng đã được cập nhật.
        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Xóa tài khoản người dùng.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Xác thực mật khẩu trước khi xóa tài khoản.
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Lấy thông tin người dùng và đăng xuất.
        $user = $request->user();
        Auth::logout();

        // Xóa tài khoản người dùng.
        $user->delete();

        // Hủy phiên làm việc và tạo lại token mới cho phiên làm việc mới.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Chuyển hướng về trang chủ.
        return Redirect::to('/');
    }
}

