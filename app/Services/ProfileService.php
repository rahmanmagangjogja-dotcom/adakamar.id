<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ProfileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileService
{
    protected ProfileRepository $profileRepository;

    public function __construct(
        ProfileRepository $profileRepository
    ) {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Ambil profil user.
     */
    public function getProfile(int $id): ?User
    {
        return $this->profileRepository->findById($id);
    }

    /**
     * Update profil user.
     */
    public function updateProfile(
        int $id,
        array $data
    ): ?User {
        return DB::transaction(function () use ($id, $data) {

            $user = $this->profileRepository->findById($id);

            if (!$user) {
                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | Password
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['password']) &&
                filled($data['password'])
            ) {
                $data['password'] = Hash::make(
                    $data['password']
                );
            } else {
                unset($data['password']);
            }

            /*
            |--------------------------------------------------------------------------
            | Photo
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['photo']) &&
                $data['photo'] instanceof UploadedFile
            ) {
                if ($user->photo) {
                    $this->deletePhoto($user->photo);
                }

                $data['photo'] = $this->storePhoto(
                    $data['photo']
                );
            } else {
                unset($data['photo']);
            }

            return $this->profileRepository->update(
                $user,
                $data
            );
        });
    }

    /**
     * Simpan foto profil.
     */
    protected function storePhoto(
        UploadedFile $file
    ): string {
        $directory = public_path('profiles');

        if (!is_dir($directory)) {
            mkdir(
                $directory,
                0755,
                true
            );
        }

        $originalName = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $filename =
            time() .
            '_' .
            Str::slug($originalName) .
            '_' .
            uniqid() .
            '.' .
            $extension;

        $file->move(
            $directory,
            $filename
        );

        return 'profiles/' . $filename;
    }

    /**
     * Hapus foto profil.
     */
    protected function deletePhoto(
        string $path
    ): void {
        $filePath = public_path(
            ltrim($path, '/')
        );

        if (
            file_exists($filePath) &&
            is_file($filePath)
        ) {
            unlink($filePath);
        }
    }
}