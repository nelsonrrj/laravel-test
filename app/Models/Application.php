<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'phase_id'
    ];

    public function phase()
    {
        return $this->belongsTo('App\Models\Phase', 'phase_id');
    }
}
