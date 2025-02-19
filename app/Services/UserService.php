<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function createUser(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->desc = $request->desc;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/users'), $imageName); // Save to public/images/users
                $user->image = 'images/users/' . $imageName; // Store path in db
            }

            $user->save();
            return $user;
        } catch (Exception $e) {
            Log::error("User creation failed: " . $e->getMessage());
            throw new Exception('Failed to create user.', 500);
        }
    }

    public function getAllUsers()
    {
        try {
            return User::all();
        } catch (Exception $e) {
            Log::error("Fetching all users failed: " . $e->getMessage());
            throw new Exception('Failed to fetch users.', 500);
        }
    }

    public function getUserById(int $id)
    {
        try {
            $user = User::findOrFail($id);
            return $user;
        } catch (Exception $e) {
            Log::error("Fetching user by ID failed: " . $e->getMessage());
            throw new Exception('Failed to fetch user.', 404);
        }
    }

    public function updateUser(Request $request, int $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name ?? $user->name;
            $user->email = $request->email ?? $user->email;
            $user->dob = $request->dob ?? $user->dob;
            $user->gender = $request->gender ?? $user->gender;
            $user->desc = $request->desc ?? $user->desc;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($user->image && Storage::exists('public/' . $user->image)) {
                    // Note: public_path() already refers to the public directory, so no need for Storage::disk('public')
                    if (file_exists(public_path($user->image))) {
                        unlink(public_path($user->image));
                    }
                }
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/users'), $imageName);
                $user->image = 'images/users/' . $imageName;
            }

            $user->save();
            return $user;
        } catch (Exception $e) {
            Log::error("User update failed: " . $e->getMessage());
            throw new Exception('Failed to update user.', 500);
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $user = User::findOrFail($id);
            // Delete user image if exists
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            $user->delete();
            return true;
        } catch (Exception $e) {
            Log::error("User deletion failed: " . $e->getMessage());
            throw new Exception('Failed to delete user.', 500);
        }
    }
}
