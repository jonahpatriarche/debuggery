<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    public $table = 'trackers';

    public function bugger()
    {
        return $this->belongsTo(Bugger::class);
    }
}
