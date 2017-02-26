<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogEntry extends Model
{
    public $table = 'logs';

    public $fillable = ['message', 'level','level_name','formatted'];
    public $guarded = ['extra', 'context'];

    /**
     * Define the relationship between LogEntry and Bugger
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bugger()
    {
        return $this->hasOne(Bugger::class);
    }

    public function levelImage()
    {
        switch($this->level_name) {
            case 'ERROR':
                return 'alert';
            default:
                return 'question-sign';
        }
    }
}
