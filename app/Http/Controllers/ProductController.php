<?php

namespace App\Http\Controllers;

use App\Eloquent\Enums\UnitEnum;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Feadbox\Tags\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        return view('products.index', [
            'products' => Product::where('title', 'like', "%{$request->q}%")->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', [
            'units' => UnitEnum::getAllTitles(),
            'tags' => Tag::collection('product')->pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        $product->tags()->attach($request->tags);

        return redirect()->route('products.index');
    }

    public function edit(Product $product): View
    {
        return view('products.edit', [
            'product' => $product,
            'units' => UnitEnum::getAllTitles(),
            'tags' => Tag::collection('product')->pluck('name', 'id'),
        ]);
    }

    public function update(StoreProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        $product->tags()->sync($request->tags);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
