<?php

namespace Modules\Process\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Electionable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'electionable_id',
        'electionable_type',
        'election_id',
    ];

    public $timestamps = false;

    // Relations

    public function electionable()
    {
        return $this->morphTo();
    }

    public function postulation()
    {
        return $this->hasMany(Postulation::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function proccesses()
    {
        return $this->belongsToMany(Process::class)->withPivot('organization_id','status','complete_plan')->withTimestamps();;
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class)->withPivot('proccess_id','status','complete_plan')->withTimestamps();;
    }
}
