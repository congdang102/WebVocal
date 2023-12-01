<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Cập nhật mật khẩu của người dùng.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate dữ liệu được gửi từ form và sử dụng session bag có tên 'updatePassword'.
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Cập nhật mật khẩu của người dùng trong cơ sở dữ liệu.
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Chuyển hướng ngược lại trang trước với thông báo cập nhật mật khẩu thành công.
        return back()->with('status', 'password-updated');
    }
}
