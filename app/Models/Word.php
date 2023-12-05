<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $table = 'words'; // Đặt tên bảng tương ứng với tên bảng trong cơ sở dữ liệu 

    protected $primaryKey = 'WordID'; // Đặt trường làm khóa chính

     // Các trường có thể gán giá trị

    protected $fillable = [
        'TopicID',
        'EnglishMeaning',
        'VietNamMeaning',
        'Image',
        
    ];

    public $timestamps = true; // Tắt tự động thêm timestamp (created_at và updated_at)

    // Các quan hệ hoặc phương thức khác có thể được định nghĩa ở đây

}
