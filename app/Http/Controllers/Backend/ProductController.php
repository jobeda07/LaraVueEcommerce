<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
      $products=Product::get();
      return Inertia::render('Backend/Product/Index',['products'=>$products]);   
    }
}
