<?php

namespace App\Http\Controllers;

use App\Domain\Account\AccountAggregateRoot;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

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
        $accountName = $request->get('name');
        $newUuid = Str::uuid()->toString();

        AccountAggregateRoot::retrieve($newUuid)
            ->createAccount($accountName, $authUser->id)
            ->persist();

        return response()->json(['response' => 'success']);
    }
}
