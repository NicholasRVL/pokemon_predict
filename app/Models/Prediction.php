<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'input_id',
        'prediction_result',
        'confidence'
    ];

    public function input()
    {
        return $this->belongsTo(Input::class);
    }
}
