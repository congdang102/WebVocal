<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Hiển thị trang yêu cầu liên kết đặt lại mật khẩu.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Xử lý yêu cầu liên kết đặt lại mật khẩu đến.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate thông tin đầu vào, yêu cầu một địa chỉ email hợp lệ.
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Gửi liên kết đặt lại mật khẩu đến người dùng có địa chỉ email đã cung cấp.
        // Sau khi thử gửi liên kết, kiểm tra phản hồi để xem thông điệp cần hiển thị cho người dùng.
        // Cuối cùng, trả về phản hồi đúng.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Nếu liên kết đã được gửi thành công, chuyển hướng về trang trước đó với thông báo thành công.
        // Ngược lại, quay lại trang trước đó với thông tin đã nhập và hiển thị lỗi.
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
