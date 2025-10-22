<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'avatar'];

    public function jiris(): BelongsToMany
    {
        return $this->belongsToMany(Jiri::class, 'attendances')->withPivot('role');
    }

    public function implementations(): HasMany
    {
        return $this->hasMany(Implementation::class);
    }

    public function homeworks(): BelongsToMany
    {
        return $this->BelongsToMany(Homework::class, 'implementations');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
