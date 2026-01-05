<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature_1',
        'feature_2',
        'feature_3'
    ];

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
}
