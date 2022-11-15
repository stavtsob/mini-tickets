<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Ticket extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'code',
        'author_id',
        'title',
        'refers_to',
        'department',
        'description',
        'priority',
        'status',
        'telephone',
        'deadline'
    ];

    public function author()
    {
        return User::find($this->author_id);
    }

    public function comments()
    {
        return TicketComment::where('ticket_id',$this->id)->get();
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'code' => $this->code,
            'title' => $this->title,
            'telephone' => $this->telephone,
            'refers_to' => $this->refers_to,
            'department' => $this->department,
            'description' => $this->description,
        ];
    }
}
