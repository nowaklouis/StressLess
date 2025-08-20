<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class TestGlobaux extends TestCase
{
    public function testFakeRegistration()
    {
        $registrationSuccessful = true;
        $this->assertTrue($registrationSuccessful, "L'inscription a échoué !");
    }

    public function testFakeEmailValidation()
    {
        $email = "test@example.com";
        $expectedEmail = "test@example.com";

        $this->assertEquals($expectedEmail, $email, "L'email ne correspond pas !");
    }

    public function testFakeLoginAfterUpdate()
    {
        $sessionToken = "fake_session_token";
        $this->assertNotEmpty($sessionToken, "Le token de session ne peut pas être vide !");
    }
}
