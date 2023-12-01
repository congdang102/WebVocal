<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Đặt tên bảng tương ứng với tên bảng trong cơ sở dữ liệu 
    protected $table = 'categories';

    // Đặt trường làm khóa chính
    protected $primaryKey = 'CategoryID';

    // Các trường có thể gán giá trị
    protected $fillable = [
        'CategoryName',
    ];

    // Tắt tự động thêm timestamp (created_at và updated_at)
    public $timestamps = true;
}