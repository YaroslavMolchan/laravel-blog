<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Article extends Model implements Transformable
{
    use TransformableTrait;

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

    protected $appends = ['publishedDate'];

    public function user()
    {
        return $this->hasOne(\App\Entities\User::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Entities\Category::class);
    }

	public function tags()
    {
        return $this->belongsToMany(\App\Entities\Tag::class);
    }

	public function comments()
    {
        return $this->hasMany(\App\Entities\ArticlesComment::class);
    }

    function getPublishedDateAttribute() {
        return $this->published_at->diffForHumans();
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // $array = $this->toArray();
        // return $array;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}
