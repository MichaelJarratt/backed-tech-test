<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //this informs laravel that these fields can be written to
    protected $fillable = [
        'name', 'email', 'comment', 'blog_id', 'title'
    ];
}
