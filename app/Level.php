<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';

    static function getLevels()
    {
        return Level::all();
    }
}
