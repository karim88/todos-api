<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'is_archived', 'project_id'
    ];

    /**
     * Get the Project (aka list) that tasks belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function project () {
        return $this->belongsTo('App\Project');
    }
}
