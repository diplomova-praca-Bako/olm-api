<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServerPolicy
{
    use HandlesAuthorization;

    public function show(User $user): bool
    {
        return $user->canAny(['server.show', 'reservation.show']);
    }

    public function create(User $user): bool
    {
        return $user->can('server.create');
    }

    public function update(User $user): bool
    {
        return $user->can('server.update');
    }

    public function delete(User $user): bool
    {
        return $user->can('server.delete');
    }

    public function restore(User $user): bool
    {
        return $user->can('server.restore');
    }

    public function sync(User $user): bool
    {
        return $user->can('server.sync');
    }

    public function show_video(User $user): bool
    {
        return $user->can('server.show_video');
    }

    public function start_video(User $user): bool
    {
        return $user->can('server.start_video');
    }

    public function stop_video(User $user): bool
    {
        return $user->can('server.stop_video');
    }
}
