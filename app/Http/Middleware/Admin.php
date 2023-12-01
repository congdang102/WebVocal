<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Xử lý một request đến.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu người dùng đăng nhập và có quyền admin
        if(Auth()->user()->usertype=='admin') {
            return $next($request); // Cho phép tiếp tục xử lý request
        }

        abort(401); // Nếu không có quyền admin, trả về lỗi 401 (Unauthenticated)
    }
}

