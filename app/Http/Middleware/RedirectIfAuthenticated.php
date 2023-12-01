<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Xử lý một request đến.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // Nếu không có guard nào được chỉ định, sử dụng guard mặc định (null)
        $guards = empty($guards) ? [null] : $guards;

        // Kiểm tra từng guard được chỉ định
        foreach ($guards as $guard) {
            // Nếu người dùng đã đăng nhập thông qua guard hiện tại
            if (Auth::guard($guard)->check()) {
                // Chuyển hướng về trang chủ của ứng dụng
                return redirect(RouteServiceProvider::HOME);
            }
        }

        // Nếu không có người dùng đã đăng nhập, tiếp tục xử lý request
        return $next($request);
    }
}
