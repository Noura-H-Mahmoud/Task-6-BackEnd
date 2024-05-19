<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    // protected $guarded = ['user_id'];
    protected $fillable=
    [
        'body',
        'post_id',
        'user_id'
    ];
    public function post()
    {
        return $this->BelongsTo(Post::class);
    }
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
