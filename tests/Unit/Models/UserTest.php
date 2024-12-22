<?php

namespace Tests\Unit\Models\Users;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    private User $user;
    private User $user2;

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
    }

    public function test_should_create_new_user(): void
    {
        $this->assertTrue($this->user->save());
        $this->assertCount(2, User::all());
    }

    public function test_should_find_by_field(): void
    {
        $foundUser = User::findByEmail('fulano@example.com');
        $this->assertEquals('fulano@example.com', $foundUser->email);
        $foundUser = User::findById(1);
        $this->assertEquals(1, $foundUser->id);
    }

    public function test_should_alter_the_name(): void
    {
        $user = User::findById(1);
        $user->name = 'Novo Nome';
        $user->save();
        $updatedUser = User::findById(1);
        $this->assertEquals('Novo Nome', $updatedUser->name);
    }

    public function test_destroy_should_remove_the_user(): void
    {
        $this->user->destroy();
        $this->assertCount(1, User::all());
    }

    // public function test_set_title(): void
    // {
    //     $problem = $this->user->problems()->new(['title' => 'Problem 2']);
    //     $this->assertEquals('Problem 2', $problem->title);
    // }

    // public function test_set_id(): void
    // {
    //     $problem = $this->user->problems()->new(['title' => 'Problem 2']);
    //     $problem->id = 7;

    //     $this->assertEquals(7, $problem->id);
    // }

    // public function test_errors_should_return_title_error(): void
    // {
    //     $problem = $this->user->problems()->new(['title' => 'Problem 2']);
    //     $problem->title = '';

    //     $this->assertFalse($problem->isValid());
    //     $this->assertFalse($problem->save());
    //     $this->assertFalse($problem->hasErrors());

    //     $this->assertEquals('não pode ser vazio!', $problem->errors('title'));
    // }

    // public function test_find_by_id_should_return_the_problem(): void
    // {
    //     $problem2 = $this->user->problems()->new(['title' => 'Problem 2']);
    //     $problem1 = $this->user->problems()->new(['title' => 'Problem 1']);
    //     $problem3 = $this->user->problems()->new(['title' => 'Problem 3']);

    //     $problem1->save();
    //     $problem2->save();
    //     $problem3->save();

    //     $this->assertEquals($problem1, Problem::findById($problem1->id));
    // }

    // public function test_find_by_id_should_return_null(): void
    // {
    //     $problem = $this->user->problems()->new(['title' => 'Problem 2']);
    //     $problem->save();

    //     $this->assertNull(Problem::findById(7));
    // }
}