<?php

namespace App\Http\Controllers;

use App\Domain\Account\AccountAggregateRoot;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

/**
 *
 */
class AccountsController extends Controller
{
    /**
     * Create an account.
     *
     * @param AccountRequest $request
     * @return JsonResponse
     */
    public function store(AccountRequest $request): JsonResponse
    {
        $authUser = auth()->user();
        $accountName = $request->name;
        $newUuid = Str::uuid()->toString();

        AccountAggregateRoot::retrieve($newUuid)
            ->createAccount($accountName, $authUser->id)
            ->persist();

        return response()->json(['response' => 'success']);
    }

    /**
     * Update the amount of an account.
     *
     * @param string $uuid
     * @param UpdateAccountRequest $request
     * @return JsonResponse
     */
    public function update(string $uuid, UpdateAccountRequest $request)
    {
        $aggregateRoot = AccountAggregateRoot::retrieve($uuid);

        $request->adding()
            ? $aggregateRoot->addMoney($request->amount)
            : $aggregateRoot->subtractMoney($request->amount);

        $aggregateRoot->persist();

        return response()->json(['response' => 'success']);
    }


    /**
     * Delete an account in the database.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function destroy(string $uuid)
    {
        AccountAggregateRoot::retrieve($uuid)
            ->deleteAccount()
            ->persist();

        return response()->json(['response' => 'success']);
    }
}
