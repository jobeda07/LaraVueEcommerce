<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\BrandResource;
use App\Http\Resources\Backend\ProductResource;
use App\Http\Resources\Backend\CategoryResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(Product::all());
        $categories = CategoryResource::collection(Category::all());
        $brands = BrandResource::collection(Brand::all());
        return Inertia::render('Backend/Product/Index', ['products' => $products, 'categories' => $categories, 'brands' => $brands]);
    }
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }
}
