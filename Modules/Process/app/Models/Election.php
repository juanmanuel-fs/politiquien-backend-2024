<?php

namespace Modules\Process\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Election extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public $timestamps = false;

    // Relations

    public function processes(){
        return $this->belongsToMany(Process::class, 'election_process');
    }

    public function positions(){
        return $this->belongsToMany(Position::class, 'election_position');
    }

}
