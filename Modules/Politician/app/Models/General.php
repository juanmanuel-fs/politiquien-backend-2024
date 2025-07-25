<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Politician\Database\factories\GeneralFactory;
use Modules\Process\Models\Candidate;
use Modules\Utility\Models\Address;

class General extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'dni',
        'name',
        'father_surname',
        'mother_surname',
        'sex',
        'birth',
        'additional',
        'candidate_id'
    ];

    public $timestamps = false;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'candidate_id';

    // Relations

    public function candidate()
    {
        return $this->bolongsTo(Candidate::class);
    }

    // Relations Polymorphic

    public function address()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
