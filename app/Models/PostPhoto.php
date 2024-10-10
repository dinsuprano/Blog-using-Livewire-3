<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'photo_path'];

// /**
//     * Get the post that owns the photo.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
// */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
