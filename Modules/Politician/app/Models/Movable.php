<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Process\Models\Candidate;

class Movable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'vehicle',
        'brand',
        'plate',
        'model',
        'characteristic',
        'year',
        'value',
        'comment',
        'candidate_id'
    ];

    public $timestamps = false;

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

}
