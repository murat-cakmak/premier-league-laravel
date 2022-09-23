<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Teams
 *
 * @property int $id
 * @property string $name
 * @property string $logo
 *
 * @package App\Models
 */

class Team extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'logo'
    ];
}
