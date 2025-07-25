<?php

namespace Modules\Process\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
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

    public function elections(){
        return $this->belongsToMany(Election::class);
    }

    public function candidates(){
        return $this->belongsToMany(Candidate::class);
    }
}
