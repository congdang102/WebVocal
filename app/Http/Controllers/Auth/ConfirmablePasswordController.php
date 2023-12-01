<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Hiển thị giao diện xác nhận mật khẩu.
     */
    public function show(): View
    {
        // Hiển thị giao diện xác nhận mật khẩu
        return view('auth.confirm-password');
    }

    /**
     * Xác nhận mật khẩu của người dùng.
     */
    public function store(Request $request): RedirectResponse
    {
        // Kiểm tra xác thực mật khẩu của người dùng
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            // Nếu mật khẩu không hợp lệ, ném ngoại lệ ValidationException với thông điệp tương ứng
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        // Lưu thời điểm xác nhận mật khẩu trong phiên làm việc
        $request->session()->put('auth.password_confirmed_at', time());

        // Chuyển hướng người dùng đến URL mong muốn hoặc trang chủ mặc định
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
