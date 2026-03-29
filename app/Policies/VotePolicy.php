<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vote;

class VotePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Vote $vote): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Vote $vote): bool
    {
        return false;
    }

    public function delete(User $user, Vote $vote): bool
    {
        return $user->is_admin || $user->is($vote->user);
    }

    public function deleteAny(User $user): bool
    {
        return $user->is_admin;
    }

    public function restore(User $user, Vote $vote): bool
    {
        return $user->is_admin;
    }

    public function forceDelete(User $user, Vote $vote): bool
    {
        return $user->is_admin;
    }
}
