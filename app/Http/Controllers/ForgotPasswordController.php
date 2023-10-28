<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PasswordResetService;
use App\Http\Requests\PassResetRequest;
use App\Http\Requests\NewPassRequest;

class ForgotPasswordController extends Controller
{
    /**
     *.Create a new PasswordResetService instance.
     *
     * @return void
     */
    public function __construct(PasswordResetService $password_reset_service)
    {
        $this->pass_reset_service = $password_reset_service;
    }

    public function sendResetLinkEmail(PassResetRequest $request)
    {
        $this->pass_reset_service->resetViaEmail($request->email);

        return response()->json([
            'status' => true,
            'message' => 'Password token sent.'
        ]);
    }
    
    public function setNewPassword(NewPassRequest $request)
    {
        $this->pass_reset_service->setNewPassword($request->email,$request->new_password);

        return response()->json([
            'status' => true,
            'message' => 'New password seted.'
        ]);
    }
}
