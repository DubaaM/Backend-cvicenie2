<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();

        return response()->json($categories, 200);
    }

    public function store(Request $request)
    {

        $id = DB::table('categories')->insertGetId([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $category = DB::table('categories')->where('id', $id)->first();

        return response()->json($category, 201);
    }

    public function show(string $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            return response()->json(['message' => 'Kategória neexistuje'], 404);
        }

        return response()->json($category, 200);
    }

    public function update(Request $request, string $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            return response()->json(['message' => 'Kategória neexistuje'], 404);
        }

        DB::table('categories')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'updated_at' => now(),
            ]);

        $updatedCategory = DB::table('categories')->where('id', $id)->first();

        return response()->json($updatedCategory, 200);
    }

    public function destroy(string $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if (!$category) {
            return response()->json(['message' => 'Kategória neexistuje'], 404);
        }

        DB::table('note_category')->where('category_id', $id)->delete();
        DB::table('categories')->where('id', $id)->delete();

        return response()->json(['message' => 'Kategória bola vymazaná'], 200);
    }
}
