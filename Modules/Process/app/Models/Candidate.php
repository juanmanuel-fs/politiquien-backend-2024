<?php

namespace Modules\Process\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Modules\Politician\Models\Basic;

class Candidate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'jne_id',
        'full_name',
        'slug',
        'dni',
        'keywords',
        'state',
        'status',
        'number',
        'year',
        'process_id',
        'position_id',
        'postulation_id',
    ];

    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($candidate) {
            $candidate->id = (string) Str::uuid();
        });
    }

    public function basics(){
        return $this->hasMany(Basic::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function process(){
        return $this->belongsTo(Process::class);
    }

    public function postulation(){
        return $this->belongsTo(Postulation::class);
    }

    use \Znck\Eloquent\Traits\BelongsToThrough;

    public function electionable()
    {
        return $this->belongsToThrough(Electionable::class, Postulation::class);
    }

    public function organization()
    {
        return $this->belongsToThrough(Organization::class, Postulation::class);
    }

}
