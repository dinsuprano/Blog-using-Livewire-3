<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'photo_path'];

    public function photos()
    {
        return $this->hasMany(PostPhoto::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function topLevelComments()
    {
        // The whereNull clause filters the comments to only include those without a parent.
        return $this->hasMany(Comment::class)->whereNull('parent_comment_id');
    }
}
