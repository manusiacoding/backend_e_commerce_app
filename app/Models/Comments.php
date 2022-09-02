<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comments extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'product_id',
        'comment'
    ];

    //relation tables
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
