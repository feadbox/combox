<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
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

    public function show(Request $request, Product $product, DateService $dateService): View
    {
        return view('product-transactions.show', [
            'dates' => $dateService->dates(),
            'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
            'branches' => Branch::pluck('name', 'id'),
            'product' => $product,
            'transactions' => $product->transactions()
                ->where('branch_id', $request->branch)
                ->whereMonth('transaction_date', $selectedDate)
                ->whereYear('transaction_date', $selectedDate)
                ->latest()
                ->paginate()
        ]);
    }
}
