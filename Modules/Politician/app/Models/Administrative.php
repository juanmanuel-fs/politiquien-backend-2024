<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Process\Models\Candidate;

class Administrative extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'sanction',
        'misconduct',
        'comment',
        'description',
        'candidate_id'
    ];

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

}
