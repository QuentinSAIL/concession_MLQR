<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'carmodel_id',
    ];

    public function carmodel()
    {
        return $this->belongsTo(Carmodel::class);
    }
}
