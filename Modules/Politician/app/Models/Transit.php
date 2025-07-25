<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Politician\Database\factories\TransitFactory;
use Modules\Process\Models\Candidate;

class Transit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'registration',
        'misconduct',
        'description',
        'comment',
        'candidate_id'
    ];

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

}
