<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Community extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'phone_number',
        'country',
        'date',
        'amount',
        'type',
        'description',
        'slip',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];
}
