<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predictions extends Model
{
    use HasFactory;
    const MARKET_TYPE_1x2 = '1x2';
    const MARKET_TYPE_CORRECT_SCORE = 'correct_score';
    const PREDICTIONS_1X2_VALUES = [1, 'X', 2];
    const PREDICTIONS_STATUS_VALUES = ['win', 'lost', 'unresolved'];

    protected $fillable = ['event_id', 'market_type', 'prediction', 'status'];
}
