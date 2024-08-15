<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendar extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['type', 'title', 'description', 'pdf', 'publish'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'publish' => 'boolean',
    ];
}
