<?php

namespace Modules\Process\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Process\Database\factories\PostulationFactory;

class Postulation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'status',
        'state',
        'complete_plan',
        'plan_id',
        'electionable_id',
        'organization_id',
        'process_id'
    ];

    // Relations

    public function processes()
    {
        return $this->belongsToMany(Process::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function plans(){
        return $this->hasMany(Plan::class);
    }

    public function electionable()
    {
        return $this->belongsTo(Electionable::class);
    }
}
