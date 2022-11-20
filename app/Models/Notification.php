<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'seen',
        'author_id',
        'url'
    ];

    public function authorName()
    {
        return User::where('id',$this->author_id)->first() ?? 'System';
    }
}
