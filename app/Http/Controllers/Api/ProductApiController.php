<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaginatedCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    /**
     * Display a listing of active products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activeProducts()
    {
        $products = Product::with('category')
        ->filterBy(request()->all())
            ->where('status', 1)
            ->paginate(10);

        return apiResponse(
            'Products retrieved successfully',
            new PaginatedCollection($products, ProductResource::class),
        );
    }
    public function allProducts()
    {
        $products = Product::with('category')
        ->filterBy(request()->all())
            ->paginate(10);

        return apiResponse(
            'Products retrieved successfully',
            new PaginatedCollection($products, ProductResource::class),
        );
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return apiResponse('Product not found', new \stdClass(), [], 404);
        }

        return apiResponse(
            'Product retrieved successfully',
            new ProductResource($product)
        );
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return apiResponse('Validation failed', new \stdClass(), $validator->errors()->toArray(), 422);
        }

        $validated = $validator->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $validated['image'] = 'images/products/' . $imageName;
        }

        $product = Product::create($validated);

        return apiResponse(
            'Product created successfully',
            new ProductResource($product),
            [],
            201
        );
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return apiResponse('Product not found', new \stdClass(), [], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'sometimes|required|boolean',
        ]);

        if ($validator->fails()) {
            return apiResponse('Validation failed', new \stdClass(), $validator->errors()->toArray(), 422);
        }

        $validated = $validator->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $validated['image'] = 'images/products/' . $imageName;
        }

        $product->update($validated);

        return apiResponse(
            'Product updated successfully',
            new ProductResource($product)
        );
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return apiResponse('Product not found', new \stdClass(), [], 404);
        }

        // Delete the product image
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return apiResponse('Product deleted successfully');
    }
}
