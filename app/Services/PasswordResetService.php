<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordResetService{

    /**
     * Reset password via email.
     */
    public function resetViaEmail($email){

            $token = Str::random(60);

            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);

            Mail::raw(
                "Enter this token in the '/api/auth/new_password/new_password' data by 'token' key : $token",
                function ($message) use ($email) {
                    $message->to($email)->subject('Reset Password Link');
                }
            );

        }

    public function setNewPassword($email, $pass){
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        User::where('email', $email)->update(['password' => bcrypt($pass)]);
    }

    }

?>