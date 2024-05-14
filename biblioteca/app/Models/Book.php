<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pages',
        'year',
        'description',
        'numcopies'
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function authors(): HasMany
    {
        return $this->hasMany(Author::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

   
}
