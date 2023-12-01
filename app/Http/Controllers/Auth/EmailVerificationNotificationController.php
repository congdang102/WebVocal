<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Gửi thông báo xác nhận email mới.
     */
    public function store(Request $request): RedirectResponse
    {
        // Kiểm tra xem người dùng đã xác nhận email chưa
        if ($request->user()->hasVerifiedEmail()) {
            // Nếu đã xác nhận, chuyển hướng người dùng đến URL mong muốn hoặc trang chủ mặc định
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Gửi thông báo xác nhận email đến người dùng
        $request->user()->sendEmailVerificationNotification();

        // Chuyển hướng ngược lại với thông báo thành công
        return back()->with('status', 'verification-link-sent');
    }
}
