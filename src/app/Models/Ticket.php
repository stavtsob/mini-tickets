<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, Searchable, InteractsWithMedia;


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

    protected $casts = [
        'deadline'  => 'date'
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

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this
    //         ->addMediaConversion('preview')
    //         ->fit(Manipulations::FIT_CROP, 300, 300)
    //         ->nonQueued();
    // }
}
