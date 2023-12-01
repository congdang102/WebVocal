<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Lớp Controller mở rộng từ BaseController và sử dụng các traits hỗ trợ.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
