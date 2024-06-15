<?php

// app/Policies/FilePolicy.php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the file.
     */
    public function view(User $user, File $file)
    {
        return $user->id === $file->user_id;
    }

    /**
     * Determine whether the user can upload files.
     */
    public function upload(User $user)
    {
        return $user->hasPermissionTo('upload files');
    }

    /**
     * Determine whether the user can edit the file.
     */
    public function update(User $user, File $file)
    {
        return $user->id === $file->user_id && $user->hasPermissionTo('edit files');
    }

    /**
     * Determine whether the user can delete the file.
     */
    public function delete(User $user, File $file)
    {
        return $user->id === $file->user_id && $user->hasPermissionTo('delete files');
    }
}
