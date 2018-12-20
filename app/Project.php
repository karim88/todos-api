<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    /**
     * Get the Project's (aka list) owner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function user () {
        return $this->belongsTo('App\User');
    }

    /**
     * Get Tasks of the Project (list)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function tasks () {
        return $this->hasMany('App\Task');
    }
}
