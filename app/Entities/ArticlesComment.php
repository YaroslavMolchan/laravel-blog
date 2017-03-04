<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ArticlesComment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'article_id',
    	'name',
    	'email',
    	'comment',
    	'ip',
    	'ua',
    	'status'
    ];

	public function aricle()
    {
        return $this->belongsTo(Article::class);
    }

}
