<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogAndNews extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function likes()
    {
        return $this->belongsToMany(User::class, 'blog_and_news_likes', 'blog_news_id', 'user_id');
    }

    public function comments()
    {
        return $this->belongsToMany(User::class, 'blog_and_news_comments', 'blog_news_id', 'user_id');
    }
    
}
