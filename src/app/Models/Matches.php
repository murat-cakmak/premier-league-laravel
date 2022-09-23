<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Match
 *
 * @property int $id
 * @property int $week_id
 * @property int $home
 * @property int $away
 *
 * @package App\Models
 */
class Matches extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'week_id' => 'int',
        'home' => 'int',
        'away' => 'int'
    ];

    protected $fillable = [
        'week_id',
        'home',
        'away'
    ];
}
