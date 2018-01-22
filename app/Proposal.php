<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    //
    public function projects(){
        return $this->belongsTo(Project::class, 'id');
    }
}
