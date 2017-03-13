<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bugger extends Model
{
    use SoftDeletes;

    public $table = 'buggers';
    public $fillable = ['message', 'level', 'level_name', 'formatted'];
    public $guarded = ['extra', 'context', 'channel'];

    /**
     * Define the relationship between LogEntry and Bugger
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tracker()
    {
        return $this->hasOne(Tracker::class);
    }

    public function getLevelIcon()
    {
        switch ($this->level_name) {
            case "DEBUG":
                return 'fa fa-search';
                break;
            case "INFO":
                return 'fa fa-info';
                break;
            case "NOTICE":
                return 'fa fa-info';
                break;
            case "WARNING":
                return 'fa fa-bug';
                break;
            case "ERROR":
                return 'fa fa-bug';
                break;
            case "CRITICAL":
                return 'fa fa-exclamation-circle';
                break;
            case "ALERT":
                return 'fa fa-exclamation-triangle';
                break;
            case "EMERGENCY":
                return 'fa fa-bull-horn';
                break;
            default:
                return 'fa fa-question';
                break;
        }

    }
}
