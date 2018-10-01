<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'title' , 'description', 'picture'
    ];
    
    protected $attributes = [
        'picture' => 'https://lorempixel.com/output/city-q-c-640-480.jpg',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
