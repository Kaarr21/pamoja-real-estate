<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Property;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_properties');
    }

    public function view(AuthUser $authUser, Property $property): bool
    {
        return $authUser->can('view_properties') && ($authUser->id === $property->agent_id || $authUser->hasRole('admin'));
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_properties');
    }

    public function update(AuthUser $authUser, Property $property): bool
    {
        return $authUser->can('update_properties') && ($authUser->id === $property->agent_id || $authUser->hasRole('admin'));
    }

    public function delete(AuthUser $authUser, Property $property): bool
    {
        return $authUser->can('delete_properties') && ($authUser->id === $property->agent_id || $authUser->hasRole('admin'));
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_properties');
    }

    public function restore(AuthUser $authUser, Property $property): bool
    {
        return $authUser->can('restore_properties') && ($authUser->id === $property->agent_id || $authUser->hasRole('admin'));
    }

    public function forceDelete(AuthUser $authUser, Property $property): bool
    {
        return $authUser->can('force_delete_properties') && ($authUser->id === $property->agent_id || $authUser->hasRole('admin'));
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_properties');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_properties');
    }

    public function replicate(AuthUser $authUser, Property $property): bool
    {
        return $authUser->can('replicate_properties') && ($authUser->id === $property->agent_id || $authUser->hasRole('admin'));
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_properties');
    }

}