<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * @param  UserRequest  $data
     * @return User|null
     */
    public function createAccount(UserRequest $data): ?User
    {
        try {
            $data->offsetSet('password', bcrypt($data->password));
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = $data->password;
            $user->save();
            $user->roles()->attach(Role::where('name', 'User')->firstOrFail());
            if ($data->hasFile('photo')) {
                $user->uploadPicture($data->photo);
            }
            $user->push();

            return $user;
        } catch (QueryException | \Swift_TransportException $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * Update Account
     *
     * @param  UserRequest  $data
     * @param $id
     * @return bool
     */
    public function updateUser(UserRequest $data, $id): bool
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $data->name;
            $user->email = $data->email;
            $user->push();
            if ($data->hasFile('photo')) {
                Storage::disk('public')->delete('user/'.$user->profile_photo_path);
                $user->uploadPicture($data->photo);
            }

            return true;
        } catch (QueryException $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @return Collection|array
     */
    public function all(): Collection|array
    {
        return User::all();
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function getAll(): AnonymousResourceCollection
    {
        $users = User::where('name', '!=', 'admin')->get();

        return UserResource::collection($users);
    }

    /**
     * @param $id
     * @return User|null
     */
    public function get($id): ?User
    {
        return User::where('id', $id)->first();
    }
}
