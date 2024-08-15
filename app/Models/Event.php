<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'type', 'description', 'image', 'publish'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'publish' => 'boolean',
    ];
}
