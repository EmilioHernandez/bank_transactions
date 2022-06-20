<?php

namespace App\Http\Controllers;

use App\Models\TransactionCount;
use Illuminate\Http\JsonResponse;


class TransactionsController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $transactionCounts = TransactionCount::with('user')
            ->orderByDesc('count')
            ->get();

        return response()->json($transactionCounts);
    }
}
