<?php

namespace Tests\Browser\Users;

use PHPUnit\Framework\TestCase as FrameworkTestCase;

class AuthenticatedTest extends FrameworkTestCase
{
    public function test_should_redirect_if_not_authenticated_to_index(): void
    {
        $page = file_get_contents('http://web/users');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_redirect_if_not_authenticated_to_show(): void
    {
        $page = file_get_contents('http://web/users/1');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_redirect_if_not_authenticated_to_edit(): void
    {
        $page = file_get_contents('http://web/users/1/edit');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }

    public function test_should_redirect_if_not_authenticated_to_new(): void
    {
        $page = file_get_contents('http://web/users/new');

        $statusCode = $http_response_header[0];
        $location = $http_response_header[10];

        $this->assertEquals('HTTP/1.1 302 Found', $statusCode);
        $this->assertEquals('Location: /login', $location);
    }
}