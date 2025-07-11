<?php

namespace App\Policies;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PersonnelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->hasRole(['Admin']) || $user->hasPermissionTo('Personnel View')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Personnel $personnel): bool
    {
        if($user->hasRole(['Admin']) || $user->hasPermissionTo('Personnel View')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->hasRole(['Admin']) || $user->hasPermissionTo('Personnel Create')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Personnel $personnel): bool
    {
        if($user->hasRole(['Admin']) || $user->hasPermissionTo('Personnel Update')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Personnel $personnel): bool
    {
        if($user->hasRole(['Admin']) || $user->hasPermissionTo('Personnel Delete')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Personnel $personnel): bool
    {
        if($user->hasRole(['Admin']) || $user->hasPermissionTo('Personnel Restore')){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Personnel $personnel): bool
    {
        if($user->hasRole(['Admin']) || $user->hasPermissionTo('Personnel Delete')){
            return true;
        }
        return false;
    }
}
