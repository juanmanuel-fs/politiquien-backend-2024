<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Process\Models\Candidate;

class Elected extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'started_at',
        'ended_at',
        'comment',
        'organization',
        'organization_id',
        'position_id',
        'candidate_id'
    ];

    public $timestamps = false;

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

}
