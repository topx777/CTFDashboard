<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Level;
use App\TeamChallenge;

class Challenge extends Model
{
    protected $table = 'challenges';

    public function Category()
    {
        return $this->belongsTo(Category::class, 'idCategory', 'id');
    }

    public function Level()
    {
        return $this->belongsTo(Level::class, 'idLevel', 'id');
    }

    public function Teams()
    {
        return $this->hasMany(TeamChallenge::class, 'idChallenge', 'id');
    }
}
