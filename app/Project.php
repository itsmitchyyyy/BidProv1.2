<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{


    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function proposals(){
        return $this->hasMany(Proposal::class, 'project_id');
    }
}
