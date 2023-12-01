<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Hiển thị giao diện đặt lại mật khẩu.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Xử lý yêu cầu đặt mật khẩu mới.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate các trường thông tin được gửi từ form.
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Thử đặt lại mật khẩu người dùng. Nếu thành công, cập nhật mật khẩu
        // trên mô hình người dùng thực tế và lưu vào cơ sở dữ liệu.
        // Nếu không thành công, xử lý lỗi và trả về phản hồi.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Gửi sự kiện thông báo rằng mật khẩu đã được đặt lại.
                event(new PasswordReset($user));
            }
        );

        // Nếu mật khẩu được đặt lại thành công, chuyển hướng người dùng về trang đăng nhập.
        // Nếu có lỗi, chuyển hướng ngược lại trang trước với thông báo lỗi.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}

