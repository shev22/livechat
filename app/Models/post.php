<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class post extends Model
{
    use HasFactory;
    use sluggable;

    protected $fillable = ['title', 'slug', 'description', 'image_path', 'user_id'];
    
    public function user()
    {
        return $this ->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' =>[
            'source' => 'title'
            ]
        ];
    }
}
