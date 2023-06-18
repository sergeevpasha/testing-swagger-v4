<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * Seed database
     *
     * @var boolean
     */
    protected bool $seed = false;

    /**
     * Determinate if database seeded
     *
     * @var boolean
     */
    protected static bool $seeded = false;

    /**
     * User with all permissions
     *
     * @var \App\Models\User
     */
    protected User $adminUser;

    /**
     * User without any permissions
     *
     * @var \App\Models\User
     */
    protected User $user;

    /**
     * Setting Up global values for our testing.
     *
     * @return void
     */
    protected function setUp(): void
    {
        if (!self::$seeded) {
            $this->seed   = true;
            self::$seeded = true;
        }

        parent::setUp();
        $this->adminUser = User::find(1);
        $this->user      = User::factory()->create();
    }
}
