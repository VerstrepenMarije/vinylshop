<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute; // Import the Attribute casting class


class Genre extends Model
{
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    // Define the "one-to-many" relationship: A Genre has many Records
    public function records(): HasMany  // Type hint return type
    {
        // Eloquent assumes the foreign key on the Record model is 'genre_id'
        // based on the owning model's name (Genre -> genre_id)
        return $this->hasMany(Record::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
        // Accessor: Called when retrieving $genre->name
            get: fn ($value) => ucfirst($value), // Capitalize first letter

            // Mutator: Called when setting $genre->name = '...' before saving
            set: fn ($value) => strtolower($value) // Convert to lowercase
        );
    }
}
