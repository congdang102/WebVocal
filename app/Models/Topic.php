<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics'; // Đặt tên bảng tương ứng với tên bảng trong cơ sở dữ liệu 

    protected $primaryKey = 'TopicID'; // Đặt trường làm khóa chính

     // Các trường có thể gán giá trị
    protected $fillable = [
        'TopicName',
        'Image',
        'SubCategoryID',
    ];
 // Các trường có thể gán giá trị

    public $timestamps = true; // Tắt tự động thêm timestamp (created_at và updated_at)

    // Các quan hệ hoặc phương thức khác có thể được định nghĩa ở đây

}
