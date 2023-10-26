<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['book_code', 'title', 'author', 'publisher', 'image_book', 'slug'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }

    public function rent()
    {
        return $this->belongsToMany(Activity::class, 'rental_logs', 'user_id', 'book_id');
    }

    public function sluggable() :array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
