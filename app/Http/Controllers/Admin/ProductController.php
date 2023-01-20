<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use App\Services\Uploader\FileUploader;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Throwable;

class ProductController extends Controller
{

    public function __construct(protected ProductRepository $productRepository, protected FileUploader $fileUploader)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $products = $this->productRepository->paginate(['id', 'title', 'price'], orderedColumn: "updated_at", direction: "desc");
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return Response
     */
    public function store(StoreProductRequest $request)
    {
        $file = $this->fileUploader->upload($request, "image", "products/images/".now()->format("Y-m-d"));
        $validated = $request->validated();
        $validated["image"] = $file;
        $product = $this->productRepository->create($validated);

        return redirect()->route("admin.product.index")->with("message", "Product {$product->title}");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validatedRequests = $request->validated();

        $file = $this->fileUploader->upload($request, "image",  "products/images/".now()->format("Y-m-d"));

        is_null($file) ?: $validatedRequests["image"] = $file;

        $this->productRepository->update($product, $validatedRequests);


        return redirect()->route('admin.product.index')->with("message", "Product {$product->title} update");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(Product $product)
    {
        $this->productRepository->delete($product);
        return redirect()->route('admin.product.index')->with("message", "Product {$product->title} delete");
    }
}
