<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return new DataResource(Auth::user(), 'success', 'get data user successfully');
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validated = $request->validate([
            'name' => 'sometimes|required',
            'password' => 'sometimes|required|min:6',
            'validate_password' => 'required',
        ]);

        if (isset($validated['name'])) {
            if (Hash::check($validated['validate_password'], $user->password)) {
                $data = $user->update(['name' => $validated['name']]);
                if ($data) {
                    return new DataResource($user, 'success', 'username updated');
                }
                return response()->json(['status' => 'failed', 'message' => 'failed update username'], 500);
            };
            return response()->json(['status' => 'failed', 'message' => 'password not match'], 500);
        }

        if (Hash::check($validated['validate_password'], $user->password)) {
            $data = $user->update(['password' => Hash::make($validated['password'])]);
            if ($data) {
                return new DataResource($user, 'success', 'password updated');
            }
            return response()->json(['status' => 'failed', 'message' => 'failed update password'], 500);
        }
        return response()->json(['status' => 'failed', 'message' => 'password not match'], 500);
    }

    public function destroy()
    {
        $data = User::find(Auth::user()->id)->delete();

        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'user deleted']);
        }
        return response()->json(['status' => 'failed', 'message' => 'failed delete user'], 500);
    }
}
