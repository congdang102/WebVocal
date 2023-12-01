<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Phương thức này trả về đường dẫn mà người dùng sẽ được chuyển hướng đến
     * khi họ chưa được xác thực.
     *
     * @param Request $request Đối tượng Request thể hiện yêu cầu của người dùng.
     * @return string|null Đường dẫn cần chuyển hướng đến nếu không xác thực,
     *                   hoặc null nếu yêu cầu là JSON.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}