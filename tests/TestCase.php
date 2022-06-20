<?php

namespace Tests;

use App\Domain\Account\AccountAggregateRoot;
use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;
use Throwable;

/**
 *
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * @var User|Collection|Model|mixed
     */
    protected User $user;

    /**
     * @var Account
     */
    protected Account $account;

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->create();

        $this->account = $this->createAccount();
    }

    /**
     * @param callable $callable
     * @param string $expectedExceptionClass
     * @throws Throwable
     */
    protected function assertExceptionThrown(callable $callable, string $expectedExceptionClass): void
    {
        try {
            $callable();

            $this->assertTrue(false, "Expected exception `{$expectedExceptionClass}` was not thrown.");
        } catch (Throwable $exception) {
            if (!$exception instanceof $expectedExceptionClass) {
                throw $exception;
            }
            $this->assertInstanceOf($expectedExceptionClass, $exception);
        }
    }

    /**
     * @return Account
     */
    protected function createAccount(): Account
    {
        $uuid = Str::uuid();

        $aggregate = AccountAggregateRoot::retrieve($uuid)
            ->createAccount('account', $this->user->id)
            ->persist();

        return Account::uuid($aggregate->uuid());
    }
}
