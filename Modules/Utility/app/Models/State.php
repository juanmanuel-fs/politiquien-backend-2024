<?php

namespace Modules\Utility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Process\Models\Election;
use Modules\Process\Models\Electionable;

class State extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'ubigeo',
        'country_id'
    ];

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    public function districts()
    {
        return $this->hasManyThrough(District::class, Province::class);
    }

    // Relations Polymorphic

    public function electionables()
    {
        return $this->morpMany(Electionable::class, 'electionable');
    }

    public function newspaperables()
    {
        // return $this->morpMany(Newspaperable::class, 'newspaperable');
    }

    public function elections()
    {
        return $this->morphToMany(Election::class, 'electionable');
    }

    public function newspapers()
    {
        // return $this->morphToMany(Newspaper::class, 'newspaperable')->withPivot('status')->withTimestamps();
    }


}
