<?php

namespace Modules\Utility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Process\Models\Election;
use Modules\Process\Models\Electionable;

class Province extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'ubigeo',
        'state_id'
    ];

    public $timestamps = false;

    // Relations

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    // Relations Polymorphic

    public function electionables()
    {
        return $this->morphMany(Electionable::class, 'electionable');
    }

    public function elections()
    {
        return $this->morphToMany(Election::class, 'electionable');
    }

    public function newspapers()
    {
        //return $this->morphToMany(Newspaper::class, 'newspaperable')->withPivot('status')->withTimestamps();
    }

}
