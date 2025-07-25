<?php

namespace Modules\Process\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Process extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'jne_id',
        'title',
        'slug',
        'subtitle',
        'slogan',
        'description',
        'date',
        'status',
        'is_current',
    ];

    // Relations

    public function elections(){
        return $this->belongsToMany(Election::class);
    }

    public function positions() {
        return $this->hasManyThrough(Position::class, Election::class, 'election_process', 'election_position');
    }

    public function postulations(){
        return $this->belongsToMany(Postulation::class);
    }

}
