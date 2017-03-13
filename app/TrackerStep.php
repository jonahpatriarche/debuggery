<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackerStep extends Model
{
    protected $table = 'tracker_steps';

    /**
     * Define relationship to tracker
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tracker()
    {
        return $this->belongsTo(Tracker::class);
    }
}
