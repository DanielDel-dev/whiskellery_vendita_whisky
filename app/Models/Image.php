<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url','post_id'
    ];

    //appartiene ad un post

    public function post(){
        $this->belongsTo(Post::class);
    }
}
