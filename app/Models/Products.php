<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comments;
use App\Models\Likes;

class Products extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'name',
        'price',
        'stock',
        'description',
        'type',
        'image'
    ];

    //relation tables
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
}
