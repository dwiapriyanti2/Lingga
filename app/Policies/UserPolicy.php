<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function roleAdmin(User $user){
        return $user->level == '1';
    }

    public function rolePimpinan(User $user){
        return $user->level == '0';
    }
}
