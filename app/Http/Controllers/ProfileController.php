<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\ProfileAvatarRequest;

class ProfileController extends Controller
{
     /**
     * Create a new UserService instance.
     * 
     * @return void
     */
    public function __construct(
        UserService $user_service,
    )
    {
        $this->user_service = $user_service;
    }

    public function updateAvatar(ProfileAvatarRequest $request){

        $this->user_service->updateAvatar(auth()->user()->id,$request->file);

        return response()->json([
            'status' => true,
            'message' => 'Avatar saved success.'
        ],200);
    }
}
