<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Politician\Database\factories\PartisanFactory;
use Modules\Process\Models\Candidate;

class Partisan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'position',
        'started_at',
        'ended_at',
        'comment',
        'organization',
        'organization_id',
        'candidate_id'
    ];

    public $timestamps = false;

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

}
