<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    public $table = 'trackers';

    /**
     * Define relationship to bugger model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bugger()
    {
        return $this->belongsTo(Bugger::class);
    }

    /**
     * Define relationship to TrackerSteps model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(TrackerStep::class);
    }
}
