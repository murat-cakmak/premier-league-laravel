<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Week
 *
 * @property int $id
 * @property string $name
 * @property int $season_id
 *
 * @package App\Models
 */

class Week extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'season_id' => 'int'
    ];

    protected $fillable = [
        'name',
        'season_id'
    ];
}
