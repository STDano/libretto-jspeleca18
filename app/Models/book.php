<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author id'];

    public function author()
    {
        return $this->belongTo(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
