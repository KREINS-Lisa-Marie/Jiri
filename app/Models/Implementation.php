<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Implementation extends Model
{
    protected $table = 'implementations';

        public function homeworks(): BelongsTo
        {
            return $this->belongsTo(Homework::class);
        }
        public function contacts(): BelongsTo
        {
            return $this->belongsTo(Contact::class);
        }

}
