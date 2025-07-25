<?php

namespace Modules\Process\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'jne_id',
        'name',
        'slug',
        'description',
        'image',
        'type',
        'registered_at',
        'phone1',
        'phone2',
        'website',
        'email',
        'holder',
        'alternate',
        'comment',
        'registered',
        'state',
        'status',
    ];

}
