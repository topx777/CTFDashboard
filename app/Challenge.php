<?php

namespace App;

use App\Category;
use App\CompetitionChallenge;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'challenges';

    public function Category()
    {
        return $this->belongsTo(Category::class, 'idCategory', 'id');
    }

    public function Competition()
    {
        return $this->hasMany(CompetitionChallenge::class, 'idChallenge', 'id');
    }
}
