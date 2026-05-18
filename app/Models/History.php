<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Guarded(['id'])]
class History extends Model
{
    protected $table = 'history';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
