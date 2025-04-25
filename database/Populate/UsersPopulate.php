<?php

namespace Database\Populate;

use App\Models\User;

class UsersPopulate
{
    public static function populate()
    {
        $data =  [
            'name' => 'Escritório Polly',
            'email' => 'escritoriopolly@gmail.com',
            'password' => 'Polly1711',
            'password_confirmation' => 'Polly1711',
            'role' => 'admin'
        ];
    
        $admin = new User($data);
        $admin->save();

        echo "Users populated with 1 admin\n";
    }
}