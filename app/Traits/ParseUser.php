<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Str;

trait ParseUser {
    public static function parseUserFromArray(array $data): User
    {
        $email = $data['email'] ?? '';
        $name = $data['name']['first'] ?? '';

        $user = User::firstOrNew(['email' =>  $email]);
 
        $user->name = $name;
        $user->password = Str::random(30);

        return $user;
    }
}