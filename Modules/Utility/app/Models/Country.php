<?php

namespace Modules\Utility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Process\Models\Election;
use Modules\Process\Models\Electionable;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'ubigeo',
    ];

    public $timestamps = false;

    // Relation

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function provinces()
    {
        return $this->hasManyThrough(Province::class, State::class);
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
