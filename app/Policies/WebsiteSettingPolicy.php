<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WebsiteSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsiteSettingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WebsiteSetting');
    }

    public function view(AuthUser $authUser, WebsiteSetting $websiteSetting): bool
    {
        return $authUser->can('View:WebsiteSetting');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WebsiteSetting');
    }

    public function update(AuthUser $authUser, WebsiteSetting $websiteSetting): bool
    {
        return $authUser->can('Update:WebsiteSetting');
    }

    public function delete(AuthUser $authUser, WebsiteSetting $websiteSetting): bool
    {
        return $authUser->can('Delete:WebsiteSetting');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:WebsiteSetting');
    }

    public function restore(AuthUser $authUser, WebsiteSetting $websiteSetting): bool
    {
        return $authUser->can('Restore:WebsiteSetting');
    }

    public function forceDelete(AuthUser $authUser, WebsiteSetting $websiteSetting): bool
    {
        return $authUser->can('ForceDelete:WebsiteSetting');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WebsiteSetting');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WebsiteSetting');
    }

    public function replicate(AuthUser $authUser, WebsiteSetting $websiteSetting): bool
    {
        return $authUser->can('Replicate:WebsiteSetting');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WebsiteSetting');
    }

}