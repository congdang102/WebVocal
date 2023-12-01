<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * Các tên của các cookie không nên được mã hóa.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
