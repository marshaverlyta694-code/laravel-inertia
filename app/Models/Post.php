<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model Eloquent yang mewakili data pada tabel posts.
class Post extends Model
{
    // Kolom yang boleh diisi sekaligus saat membuat atau memperbarui post.
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'title', 'content'
    ];
}
