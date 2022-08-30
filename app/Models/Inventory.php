<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory';

    protected $fillable = [
        'vehicle_type',
        'vehicle_type_id',
        'added_by',
        'added_on',
        'sold_to',
        'status',
    ];
    protected $casts = [
        'integer' => 'vehicle_type_id',
        'integer' => 'added_by',
        'integer' => 'sold_to',
        'integer' => 'status',
        'date' => 'added_on',
    ];
}
