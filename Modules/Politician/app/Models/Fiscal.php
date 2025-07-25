<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Politician\Database\factories\FiscalFactory;
use Modules\Process\Models\Candidate;

class Fiscal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'complaint',
        'state',
        'crime',
        'description',
        'comment',
        'candidate_id'
    ];

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }
}
