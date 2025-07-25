<?php

namespace Modules\Utility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Process\Models\Election;
use Modules\Process\Models\Electionable;

class District extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'ubigeo',
        'province_id'
    ];

    public $timestamps = false;
    // Relations

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    use \Znck\Eloquent\Traits\BelongsToThrough;

    public function state()
    {
        return $this->belongsToThrough(State::class, Province::class);
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
