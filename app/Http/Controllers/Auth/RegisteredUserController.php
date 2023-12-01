<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Hiển thị trang đăng ký.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Xử lý yêu cầu đăng ký được gửi đến.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate các trường dữ liệu được gửi trong yêu cầu đăng ký.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Tạo một bản ghi mới trong bảng 'users' với thông tin người dùng từ yêu cầu.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kích hoạt sự kiện 'Registered' và thông báo hệ thống về sự kiện đăng ký.
        event(new Registered($user));

        // Đăng nhập người dùng mới đăng ký.
        Auth::login($user);

        // Chuyển hướng người dùng sau khi đăng ký thành công đến trang được chỉ định trong RouteServiceProvider.
        return redirect(RouteServiceProvider::HOME);
    }
}
