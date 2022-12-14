<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\LoginHistory;
use App\Http\Resources\LoginHistoryResource;

class ProfileController extends Controller
{
    public function updateAccount(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return response([
            'user' => $user,
            'message' => 'Personal Information Updated.'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();
        
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password']
        ]);

        $user->update(['password' => bcrypt($request->new_password)]);

        return response([
            'message' => 'Password Updated.'
        ]);         
    }

    public function loginHistory($email)
    {
        $logs = LoginHistory::where('email', $email)
            ->orderBy('id', 'desc')
            ->paginate(12);

        return LoginHistoryResource::collection($logs);
    }
}
