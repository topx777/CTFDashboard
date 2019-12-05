<?php

namespace App;

use App\User;
use App\Competition;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    //
    protected $table = 'judges';

    public function Competitions()
    {
        return $this->hasMany(Competition::class, 'idJudge', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
