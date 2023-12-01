<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Xác nhận địa chỉ email của người dùng đã xác thực.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Kiểm tra xem địa chỉ email của người dùng đã được xác thực chưa.
        if ($request->user()->hasVerifiedEmail()) {
            // Nếu đã xác thực, chuyển hướng đến trang chủ với tham số 'verified=1'.
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        // Nếu chưa xác thực, đánh dấu email của người dùng là đã xác thực.
        if ($request->user()->markEmailAsVerified()) {
            // Kích hoạt sự kiện 'Verified' và thông báo rằng email đã được xác thực.
            event(new Verified($request->user()));
        }

        // Chuyển hướng đến trang chủ với tham số 'verified=1'.
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
