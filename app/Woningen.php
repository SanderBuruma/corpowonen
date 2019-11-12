<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Woningen extends Model
{
    public function users()
    {
        return $this->hasOne('App\Bronnen');
    }
}
