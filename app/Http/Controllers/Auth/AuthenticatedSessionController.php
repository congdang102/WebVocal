<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Hiển thị giao diện đăng nhập.
     */
    public function create(): View
    {
        // Hiển thị giao diện đăng nhập
        return view('auth.login');
    }

    /**
     * Xử lý yêu cầu xác thực đăng nhập.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Thử xác thực người dùng dựa trên thông tin đăng nhập được cung cấp
        $request->authenticate();

        // Tạo mới phiên làm việc để bảo vệ khỏi các cuộc tấn công chiếm phiên
        $request->session()->regenerate();

        // Chuyển hướng người dùng đến URL mong muốn hoặc trang chủ mặc định
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Hủy phiên làm việc đã xác thực (đăng xuất người dùng).
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Đăng xuất người dùng thông qua guard 'web'
        Auth::guard('web')->logout();

        // Vô hiệu hóa phiên làm việc của người dùng
        $request->session()->invalidate();

        // Tạo mới token CSRF để tăng cường an ninh
        $request->session()->regenerateToken();

        // Chuyển hướng người dùng về trang chủ sau khi đăng xuất
        return redirect('/');
    }
}
