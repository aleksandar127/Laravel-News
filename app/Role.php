<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function abilities()
    {
        return $this->belongsToMany('App\Ability');
    }
}
