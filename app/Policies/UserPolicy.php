<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Policies;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

/**
 * Description of AdminPolicy
 *
 * @author pawel
 */
class UserPolicy {
    
    public function administration(User $user)
    {
        return (int)$user->role_id === 2;
    }
    
}
