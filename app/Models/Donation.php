<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'type',
        'first_name',
        'last_name',
        'country',
        'email',
        'address',
        'phone_number',
        'date',
        'description',
        'amount',
        'slip',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];
}
