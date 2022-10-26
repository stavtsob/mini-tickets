<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'author_id',
        'title',
        'refers_to',
        'department',
        'description',
        'priority',
        'status'
    ];

    public function author()
    {
        return User::find($this->author_id);
    }

    public function comments()
    {
        return TicketComment::where('ticket_id',$this->id)->get();
    }
}
