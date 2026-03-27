<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::getAllCategories();

        return response()->json($categories, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100', 'unique:categories,name'],
            'color' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $category = Category::createCategory($validated);

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

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            'color' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $category->updateCategoryData($validated);

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
