<?php

namespace Tests\Unit\Models\Users;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    private User $user;
    private User $user2;
    private User $user3;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new User([
            'name' => 'User 1',
            'email' => 'fulano@example.com',
            'role' => 'admin',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        $this->user->save();

        $this->user2 = new User([
            'name' => 'User 2',
            'email' => 'fulanoaaa@example.com',
            'role' => 'admin',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        $this->user2->save();

        $this->user3 = new User([
            'name' => 'User 2',
            'email' => 'fulanoaaa@example.com',
            'role' => 'admin',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        $this->user3->save();
    }

    public function test_should_create_new_user(): void
    {
        $this->assertTrue($this->user->save());
    }

    public function test_should_not_create_new_user(): void
    {
        $this->user3->validates();
        $this->assertFalse($this->user3->save());
        $this->assertCount(2, User::all());
    }

    public function test_should_find_by_field(): void
    {
        $foundUser = User::findByEmail('fulano@example.com');
        $this->assertEquals('fulano@example.com', $foundUser->email);
        $foundUser = User::findById(1);
        $this->assertEquals(1, $foundUser->id);
        $this->assertCount(2, User::all());
    }

    public function test_should_alter_the_name(): void
    {
        $user = User::findById(1);
        $user->name = 'Novo Nome';
        $user->update(['name' => 'Novo Nome']);
        $updatedUser = User::findById(1);
        $this->assertEquals('Novo Nome', $updatedUser->name);
    }

    public function test_destroy_should_remove_the_user(): void
    {
        $this->user->destroy();
        $this->assertCount(1, User::all());
    }
}