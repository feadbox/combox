<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Services\DateService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductTransactionController extends Controller
{
    public function index(Request $request, DateService $dateService): View
    {
        return view('product-transactions.index', [
            'dates' => $dateService->dates(),
            'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
            'branches' => Branch::pluck('name', 'id'),
            'products' => Product::query()
                ->withSum(['transactions' => function ($query) use ($request, $selectedDate) {
                    $query
                        ->where('branch_id', $request->branch)
                        ->whereMonth('transaction_date', $selectedDate)
                        ->whereYear('transaction_date', $selectedDate);
                }], 'price')
                ->paginate(),
        ]);
    }
}
