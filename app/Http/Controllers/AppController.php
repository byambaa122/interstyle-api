<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function getUser(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $user,
        ]);
    }

    public function quotes()
    {
        $quotes = \App\Models\Quote::all();

        return response()->json([
            'quotes' => $quotes,
        ]);
    }

    public function features()
    {
        $features = \App\Models\Feature::all();

        return response()->json([
            'features' => $features,
        ]);
    }

    public function products(Request $request)
    {
        $id = $request->query('id');
        $rowsPerPage = $request->query('rowsPerPage', 15);
        $products = \App\Models\Product::when($id, function ($query) use ($id) {
                $query->where('product_category_id', $id);
            })
            ->latest()
            ->paginate($rowsPerPage);

        return response()->json($products);
    }

    public function materials(Request $request)
    {
        $id = $request->query('id');
        $rowsPerPage = $request->query('rowsPerPage', 15);
        $materials = \App\Models\Material::when($id, function ($query) use ($id) {
                $query->where('material_category_id', $id);
            })
            ->latest()
            ->paginate($rowsPerPage);

        return response()->json($materials);
    }

    public function showProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        return response()->json([
            'product' => $product,
        ]);
    }

    public function showMaterial($id)
    {
        $material = \App\Models\Material::findOrFail($id);

        return response()->json([
            'material' => $material,
        ]);
    }

    public function specialProducts(Request $request)
    {
        $limit = $request->query('limit', 8);
        $products = \App\Models\Product::where('is_special', true)
            ->latest()
            ->take($limit)
            ->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function specialMaterials(Request $request)
    {
        $limit = $request->query('limit', 8);
        $materials = \App\Models\Material::where('is_special', true)
            ->latest()
            ->take($limit)
            ->get();

        return response()->json([
            'materials' => $materials,
        ]);
    }

    public function productCategories()
    {
        $productCategories = \App\Models\ProductCategory::withCount('products')
            ->get();

        return response()->json([
            'productCategories' => $productCategories,
        ]);
    }

    public function materialCategories()
    {
        $materialCategories = \App\Models\MaterialCategory::withCount('materials')
            ->get();

        return response()->json([
            'materialCategories' => $materialCategories,
        ]);
    }

    public function suggestProducts(Request $request, $id)
    {
        $limit = $request->query('limit', 4);
        $products = \App\Models\Product::where('product_category_id', 1)
            ->take($limit)
            ->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function suggestMaterials(Request $request, $id)
    {
        $limit = $request->query('limit', 4);
        $materials = \App\Models\Material::where('material_category_id', 1)
            ->take($limit)
            ->get();

        return response()->json([
            'materials' => $materials,
        ]);
    }
}
