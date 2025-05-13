<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of all categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        return apiResponse(
            'Categories retrieved successfully',[
                'categories' => CategoryResource::collection($categories)
            ]
        );
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return apiResponse('Category not found', new \stdClass(), [], 404);
        }

        return apiResponse(
            'Category retrieved successfully',
            new CategoryResource($category)
        );
    }
}
