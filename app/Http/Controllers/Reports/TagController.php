<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Product;
use App\Services\DateService;
use Feadbox\Tags\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(Request $request, DateService $dateService): View
    {
        return view('reports.tags.index', [
            'dates' => $dateService->dates(),
            'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
            'branches' => Branch::pluck('name', 'id'),
            'tags' => $tags = Tag::select('id', 'name')->paginate(50),
            'tagPayments' => Tag::query()
                ->select(['tags.id', DB::raw('Sum(`account_payments`.`price`) as `price`')])
                ->join('taggables', 'taggables.tag_id', '=', 'tags.id')
                ->join('products', 'products.id', '=', 'taggables.taggable_id')
                ->join('account_payments', 'account_payments.relation_id', 'products.id')
                ->where('taggables.taggable_type', Product::class)
                ->where('account_payments.relation_type', Product::class)
                ->where('account_payments.branch_id', $request->branch)
                ->whereMonth('account_payments.payment_date', $selectedDate)
                ->whereYear('account_payments.payment_date', $selectedDate)
                ->whereIn('tags.id', $tags->pluck('id'))
                ->groupBy('tags.id')
                ->get(),
        ]);
    }

    // public function show(Request $request, Product $product, DateService $dateService): View
    // {
    //     return view('reports.products.show', [
    //         'dates' => $dateService->dates(),
    //         'selectedDate' => $selectedDate = $dateService->selectedDate($request->date),
    //         'branches' => Branch::pluck('name', 'id'),
    //         'product' => $product,
    //         'payments' => $product->payments()
    //             ->where('branch_id', $request->branch)
    //             ->whereMonth('payment_date', $selectedDate)
    //             ->whereYear('payment_date', $selectedDate)
    //             ->latest()
    //             ->paginate()
    //     ]);
    // }
}
