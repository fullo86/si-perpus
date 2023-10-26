<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table    = 'categories';
    protected $fillable = ['category_name', 'slug'];

    public function sluggable() :array
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }
}
