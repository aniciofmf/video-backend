<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\File;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function destroy(User $user, File $file) {
        return $user->id === $file->user_id;
    }

    public function createLink(User $user, File $file) {
        return $user->id === $file->user_id;
    }
}
