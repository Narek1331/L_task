<?php
namespace App\Services;

use App\Models\User;
use App\Models\Role;
use App\Services\FileService;

class UserService{

    /**
     * Create a new FileService instance.
     * 
     * @return void
     */
    public function __construct(
        FileService $file_service,
    )
    {
        $this->file_service = $file_service;
    }

    /**
     * Create user.
     */
    public function store($name, $last_name, $email, $password, $role_id){
        return User::create([
            'name' => $name,
            'last_name' => $last_name,
            'email' => $email,
            'role_id' => $role_id,
            'password' => $password
        ]);
    }

    /**
     * Get users.
     */
    public function all(){
        return User::get();
    }

    /**
     * Get me info by id.
     */
    public function getMeInfo($id){
        return User::with('role')->find($id);
    }

    /**
     * Get all employee users.
     */
    public function getEmployeeUsers(){
        $employee_role = Role::where('name','employee')->first();
        return User::select(['name','email','id'])->where('role_id',$employee_role->id)->get();
    }
    
    /**
     * Update user avatar.
     */
    public function updateAvatar($id,$file){
        $user = User::findOrFail($id);

        if($user->avatar){
            $this->file_service->destroyFileByName($user->avatar);
        }
        
        $fileName = $this->file_service->uploadbase64Image($file);

        $user->avatar = $fileName;

        return $user->save();
    }


}

?>