<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Season
 *
 * @property int $id
 * @property string $name
 * @property bool $finished
 *
 * @package App\Models
 */
class Season extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'finished' => 'bool'
    ];

    protected $fillable = [
        'name',
        'finished'
    ];
}
