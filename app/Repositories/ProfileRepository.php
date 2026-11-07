<?php

namespace App\Repositories;

use App\Models\User;

class ProfileRepository
{
    /**
     * Ambil user berdasarkan ID.
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Update profil user.
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user->fresh();
    }
}