<?php

namespace App;

use App\Team;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $table = 'members';


    public function Team()
    {
        return $this->belongsTo(Team::class, 'idTeam', 'id');
    }
}
