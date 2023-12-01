<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $table = 'folder'; // Tên bảng tương ứng trong cơ sở dữ liệu

    protected $primaryKey = 'FolderID'; // Trường làm khóa chính
    
    
    // Các trường có thể gán giá trị
    protected $fillable = [
        'WordID',
        'UserID',
    ];
    
    

    public $timestamps = true; // Tự động thêm timestamp (created_at và updated_at)

    
}

