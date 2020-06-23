<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // geeft alle categorieën
    public function show()
    {
        $categories = \DB::table('categories')
            ->get();

        return view('categories', [
            'categories' => $categories
        ]);
    }

    // geeft product bij de juiste categorie
    public function showItems($id)
    {
        $category = \DB::table('categories')
            ->where('id', $id)
            ->get();

        $products = \DB::table('products AS p')
            ->join('category_product', 'category_id', '=', 'p.id')
            ->select('p.id', 'p.title', 'p.description', 'p.price')
            ->where('category_product.product_id', $id)
            ->get();

        return view('showItem', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}