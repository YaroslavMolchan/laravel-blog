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

    public function avatar()
    {
        return 'http://www.gravatar.com/avatar/'.md5($this->email).'fs=50';
    }

	public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(ArticlesComment::class, 'parent_id', 'id');
    }
}
