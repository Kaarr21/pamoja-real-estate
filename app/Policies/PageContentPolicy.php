<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PageContent;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageContentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PageContent');
    }

    public function view(AuthUser $authUser, PageContent $pageContent): bool
    {
        return $authUser->can('View:PageContent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PageContent');
    }

    public function update(AuthUser $authUser, PageContent $pageContent): bool
    {
        return $authUser->can('Update:PageContent');
    }

    public function delete(AuthUser $authUser, PageContent $pageContent): bool
    {
        return $authUser->can('Delete:PageContent');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PageContent');
    }

    public function restore(AuthUser $authUser, PageContent $pageContent): bool
    {
        return $authUser->can('Restore:PageContent');
    }

    public function forceDelete(AuthUser $authUser, PageContent $pageContent): bool
    {
        return $authUser->can('ForceDelete:PageContent');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PageContent');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PageContent');
    }

    public function replicate(AuthUser $authUser, PageContent $pageContent): bool
    {
        return $authUser->can('Replicate:PageContent');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PageContent');
    }

}