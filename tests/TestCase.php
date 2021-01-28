<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = "/api/v1/";

    public function setUp(): void
    {
        parent::setUp();

        $this->singIn();
    }

    public function singIn()
    {
        Passport::actingAs(create('App\User'));
    }
}
