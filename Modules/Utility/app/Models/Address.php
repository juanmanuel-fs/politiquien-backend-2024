<?php

namespace Modules\Utility\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'street',
        'country',
        'state',
        'province',
        'district',
        'ubigeo',
        'is_birth',
        'addressable_id',
        'addressable_type',
    ];

    // Relations

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Relation polymorphic
    public function addressable()
    {
        return $this->morphTo();
    }

}
