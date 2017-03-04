<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    protected $fillable = [
		'user_id',
		'category_id',
        'title',
        'alias',
        'description',
        'short_description',
        'hits',
        'status',
        'image',
        'published_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

	public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticlesComment::class);
    }
}