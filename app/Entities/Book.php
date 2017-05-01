<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];

    public function authors()
    {
        return $this->belongsToMany(BookAuthor::class);
    }
}
