<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'date',
        'feature_image',
        'gallery',
        'quantity',
        'price',
        'publish',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'datetime',
        'gallery' => 'array',
        'publish' => 'boolean',
    ];
}
