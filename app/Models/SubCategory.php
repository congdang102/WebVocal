<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories'; // Đặt tên bảng tương ứng với tên bảng trong cơ sở dữ liệu của bạn

    protected $primaryKey = 'SubCategoryID'; // Đặt trường làm khóa chính
    protected $fillable = [
        'CategoryID',
        'SubCategoryName',
        'Image',
    ];
 // Các trường có thể gán giá trị

    public $timestamps = true; // Tắt tự động thêm timestamp (created_at và updated_at)

    // Các quan hệ hoặc phương thức khác có thể được định nghĩa ở đây

}