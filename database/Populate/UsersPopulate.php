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

        $data =  [
            'name' => 'Fulano',
            'email' => 'fulano@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'role' => 'user'
        ];

        $user = new User($data);
        $user->save();

        $numberOfUsers = 10;

        for ($i = 1; $i < $numberOfUsers; $i++) {
            $data =  [
                'name' => 'Fulano ' . $i,
                'email' => 'fulano' . $i . '@example.com',
                'password' => '123456',
                'password_confirmation' => '123456',
                'role' => 'user'
            ];

            $user = new User($data);
            $user->save();
        }

        echo "Users populated with $numberOfUsers registers\n";
    }
}