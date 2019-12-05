<?php

namespace App;

use App\Challenge;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    static function getCategories()
    {
        return Category::all();
    }

    public function Challenges()
    {
        return $this->hasMany(Challenge::class, 'idCategory', 'id');
    }
}
