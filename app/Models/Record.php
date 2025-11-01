<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo

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
}
