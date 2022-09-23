<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class League
 *
 * @property int $id
 * @property int $team_id
 * @property int $points
 * @property int $played
 * @property int $won
 * @property int $lose
 * @property int $draw
 *
 * @package App\Models
 */
class League extends Model
{
    use HasFactory;

    protected $table = 'league';
    public $timestamps = false;

    protected $casts = [
        'team_id' => 'int',
        'points' => 'int',
        'played' => 'int',
        'won' => 'int',
        'draw' => 'int',
        'lose' => 'int',
    ];

    protected $fillable = [
        'team_id',
        'points',
        'played',
        'won',
        'lose',
        'draw',
    ];
}
