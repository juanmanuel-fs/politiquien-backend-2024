<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Politician\Database\factories\OtherPostgraduateFactory;
use Modules\Process\Models\Candidate;

class OtherPostgraduate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'university',
        'specialty',
        'concluded',
        'is_graduate',
        'degree',
        'year_degree',
        'comment',
        'candidate_id'
    ];

    public $timestamps = false;

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

}
