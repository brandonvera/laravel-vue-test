<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            $user->name = $request->name;
            $user->update();
            
            return response()->json(['message' => 'update completed'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 400);
        }
    }

    public function blockUser(Request $request)
    {
        try{
            $u = Auth::user();

            if($u->role != 1){
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $user = User::findOrFail($request->user_id);
            $user->status = $request->status;
            $user->update();
            return response()->json(['message' => 'User status changed!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 400);
        }
    }
}
