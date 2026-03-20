<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::getAllCategories();

        return response()->json($categories, 200);
    }


    public function store(Request $request)
    {

        $category = Category::createCategory($request->all());

        return response()->json($category, 201);
    }


    public function show(string $id)
    {
        $category = Category::findCategoryById($id);

        if (!$category) {
            return response()->json(['message' => 'Kategória neexistuje'], 404);
        }

        return response()->json($category, 200);
    }


    public function update(Request $request, string $id)
    {
        $category = Category::findCategoryById($id);

        if (!$category) {
            return response()->json(['message' => 'Kategória neexistuje'], 404);
        }

        $category->updateCategoryData($request->all());

        return response()->json($category->fresh(), 200);
    }


    public function destroy(string $id)
    {
        $category = Category::findCategoryById($id);

        if (!$category) {
            return response()->json(['message' => 'Kategória neexistuje'], 404);
        }

        $category->deleteCategory();

        return response()->json(['message' => 'Kategória bola vymazaná'], 200);
    }
}
