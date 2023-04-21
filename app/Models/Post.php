<?php

namespace App\Models;

use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements CanVisit
{
    use HasFactory;
    use HasVisits;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'image_path',
        'views_count',
    ];

    public function comments()
    {
        $this->hasMany(Comment::class);
    }
}
