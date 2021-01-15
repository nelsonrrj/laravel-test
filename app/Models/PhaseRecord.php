<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhaseRecord extends Model
{
    use HasFactory;

    public $fillable = [
        'phase_id',
        'application_count',
        'created_at'
    ];

    public $timestamps = false;
}
