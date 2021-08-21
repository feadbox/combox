<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Product;
use App\Services\DateService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request, DateService $dateService): View
    {
        return view('reports.products.index', [
            'dates' => $dateService->dates(),
            'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
            'branches' => Branch::pluck('name', 'id'),
            'products' => Product::query()
                ->withSum(['payments' => function ($query) use ($request, $selectedDate) {
                    $query
                        ->where('branch_id', $request->branch)
                        ->whereMonth('payment_date', $selectedDate)
                        ->whereYear('payment_date', $selectedDate);
                }], 'price')
                ->paginate(50),
        ]);
    }

    public function show(Request $request, Product $product, DateService $dateService): View
    {
        return view('reports.products.show', [
            'dates' => $dateService->dates(),
            'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
            'branches' => Branch::pluck('name', 'id'),
            'product' => $product,
            'payments' => $product->payments()
                ->where('branch_id', $request->branch)
                ->whereMonth('payment_date', $selectedDate)
                ->whereYear('payment_date', $selectedDate)
                ->latest()
                ->paginate()
        ]);
    }
}
