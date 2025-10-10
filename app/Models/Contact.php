<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];


    function jiris():BelongsToMany
    {
        return $this->belongsToMany(Jiri::class, 'attendances');
    }

    function implementations():HasMany
    {
        return $this->hasMany(Implementation::class);
    }

    function homeworks():BelongsToMany
    {
        return $this->BelongsToMany(Homework::class, 'implementations');
    }
    function attendances():HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
