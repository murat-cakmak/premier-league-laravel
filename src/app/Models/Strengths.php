<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Strengths
 *
 * @property int $id
 * @property int $team_id
 * @property bool $is_home
 * @property string $strength
 *
 * @package App\Models
 */

class Strengths extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'team_id' => 'int',
        'is_home' => 'bool'
    ];

    protected $fillable = [
        'team_id',
        'is_home',
        'strength'
    ];
}
