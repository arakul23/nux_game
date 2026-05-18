<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class UserRegistrationService
{
    public function register(array $data): User
    {
        $data['identifier'] = Str::random(10);

        $user = new User();
        $user->fill($data);
        $user->save();

        return $user;
    }
}
