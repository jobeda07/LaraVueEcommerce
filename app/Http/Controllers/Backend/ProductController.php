<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\ProductResource;

class ProductController extends Controller
{
    public function index(){
      $products=ProductResource::collection(Product::all());
      return Inertia::render('Backend/Product/Index',['products'=>$products]);   
    }
}
