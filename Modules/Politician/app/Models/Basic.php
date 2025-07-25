<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Politician\Database\factories\BasicFactory;
use Modules\Process\Models\Candidate;

class Basic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'concluded',
        'level',
        'candidate_id'
    ];

    public $timestamps = false;

    // Relations

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

}
