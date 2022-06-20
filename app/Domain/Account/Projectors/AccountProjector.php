<?php

namespace App\Domain\Account\Projectors;

use App\Domain\Account\Events\AccountCreated;
use App\Domain\Account\Events\AccountDeleted;
use App\Domain\Account\Events\MoneyAdded;
use App\Domain\Account\Events\MoneySubtracted;
use App\Models\Account;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class AccountProjector extends Projector
{
    /**
     * @param AccountCreated $event
     */
    public function onAccountCreated(AccountCreated $event)
    {
        Account::create([
            'uuid' => $event->aggregateRootUuid(),
            'name' => $event->name,
            'user_id' => $event->userId,
        ]);
    }

    /**
     * @param MoneyAdded $event
     */
    public function onMoneyAdded(MoneyAdded $event)
    {
        $account = Account::uuid($event->aggregateRootUuid());

        $account->balance += $event->amount;

        $account->save();
    }

    /**
     * @param MoneySubtracted $event
     */
    public function onMoneySubtracted(MoneySubtracted $event)
    {
        $account = Account::uuid($event->aggregateRootUuid());

        $account->balance -= $event->amount;

        $account->save();
    }

    /**
     * @param AccountDeleted $event
     */
    public function onAccountDeleted(AccountDeleted $event)
    {
        Account::uuid($event->aggregateRootUuid())->delete();
    }
}
