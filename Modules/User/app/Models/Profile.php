<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Modules\User\Database\factories\ProfileFactory;

class Profile extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

/*    protected static function newFactory(): ProfileFactory
    {
        //return ProfileFactory::new();
    }*/
}
