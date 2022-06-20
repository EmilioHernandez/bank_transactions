<?php

namespace App\Http\Controllers;

use App\Domain\Account\AccountAggregateRoot;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class AccountsController extends Controller
{
    /**
     * Shows the list of accounts by user.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $authUser = auth()->user();
        $accounts = Account::where('user_id', $authUser->id)
            ->get();

        return response()->json($accounts);
    }

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

        return response()->json(defaultResponse());
    }

    /**
     * Update the amount of an account.
     *
     * @param string $uuid
     * @param UpdateAccountRequest $request
     * @return JsonResponse
     */
    public function update(string $uuid, UpdateAccountRequest $request): JsonResponse
    {
        $aggregateRoot = AccountAggregateRoot::retrieve($uuid);

        $request->adding()
            ? $aggregateRoot->addMoney($request->amount)
            : $aggregateRoot->subtractMoney($request->amount);

        $aggregateRoot->persist();

        return response()->json(defaultResponse());
    }


    /**
     * Delete an account in the database.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function destroy(string $uuid): JsonResponse
    {
        AccountAggregateRoot::retrieve($uuid)
            ->deleteAccount()
            ->persist();

        return response()->json(defaultResponse());
    }
}
