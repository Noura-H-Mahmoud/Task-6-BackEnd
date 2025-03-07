<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'title',
        'body',
        'category_id',
        'user_id'
    ];
    public function category()
    {
        return $this->BelongsTo(Category::class);
    }
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
