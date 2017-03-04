<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ArticlesComment extends Model
{
    protected $fillable = [
    	'article_id',
    	'name',
    	'email',
    	'comment',
    	'ip',
    	'ua',
    	'status',
        'parent_id'
    ];

	public function aricle()
    {
        return $this->belongsTo(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticlesComment::class, 'id', 'parent_id');
    }
}
