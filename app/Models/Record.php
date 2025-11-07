<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute; // Import Attribute class
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo
use Storage; // Import Storage facade
use Illuminate\Database\Eloquent\Builder; // Import Builder



class Record extends Model
{
    protected $guarded = ['id', 'created_at' , 'updated_at'];



    // Define the "many-to-one" relationship: A Record belongs to a Genre
    public function genre(): BelongsTo // Type hint return type
    {
        // Eloquent assumes the foreign key on *this* model (Record) is 'genre_id'
        // based on the relationship method name ('genre' -> 'genre_id')
        // It assumes the key on the related Genre model is 'id'.
        return $this->belongsTo(Genre::class)->withDefault(); // Use withDefault() as good practice
    }


    protected function genreName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Check if genre_id exists in the attributes array
                if (isset($attributes['genre_id'])) {
                    $genre = Genre::find($attributes['genre_id']);
                    return $genre ? $genre->name : null; // Return name or null if genre not found
                }
                return null; // Return null if genre_id is not set
            }
        );
    }

    protected function cover(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Ensure mb_id exists in the attributes array
                if (isset($attributes['mb_id']) && $attributes['mb_id']) {
                    $coverPath = 'covers/' . $attributes['mb_id'] . '.jpg';
                    // Check if the file exists in the 'public' disk
                    if (Storage::disk('public')->exists($coverPath)) {
                        // Return the public URL for the cover
                        return Storage::disk('public')->url($coverPath);
                    }
                }
                // Return the URL for the default 'no-cover' image
                return Storage::disk('public')->url('covers/no-cover.png');
            }
        );
    }

    // New accessor for listenUrl
    public function getListenUrlAttribute(): string
    {
        return 'https://listenbrainz.org/player/release/' . $this->mb_id;
    }

    public function scopeMaxPrice($query, float $price = 100): Builder
    {
        // Apply the where clause to the query builder instance
        return $query->where('price', '<=', $price);
    }


    // Attributes to append to the model's array form.
    protected $appends = ['genre_name', 'cover', 'listen_url']; // Add snake_case name here
}
