<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    public $table = 'trackers';
    public $fillable = [
        'name',
        'bugger_id',
        'description',
        'is_active',
        'is_resolved',
        'created_at',
        'updated_at'
    ];

    /**
     * Define relationship to bugger model
     *  - include models that have been soft-deleted
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bugger()
    {
        return $this->belongsTo(Bugger::class)->withTrashed();
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
