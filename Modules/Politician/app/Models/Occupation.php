<?php

namespace Modules\Politician\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Utility\Models\Address;

class Occupation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'workplace',
        'occupation',
        'ruc',
        'started_at',
        'ended_at',
        'comment',
        'candidate_id'
    ];

    public $timestamps = false;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'candidate_id';


    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
