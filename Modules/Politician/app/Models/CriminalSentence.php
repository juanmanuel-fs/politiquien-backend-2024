<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Politician\Database\factories\CriminalSentenceFactory;
use Modules\Process\Models\Candidate;

class CriminalSentence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'expedient',
        'date',
        'judicial_authority',
        'crime',
        'ruling',
        'morality',
        'other_morality',
        'ruling_fulfilled',
        'comment',
        'candidate_id'
    ];
    
    public $timestamps = false;

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

}
