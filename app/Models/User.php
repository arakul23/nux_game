<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['username', 'phonenumber',])]
class User extends Authenticatable
{
    public int $id;

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
