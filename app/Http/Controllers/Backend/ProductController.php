<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\BrandResource;
use App\Http\Resources\Backend\ProductResource;
use App\Http\Resources\Backend\CategoryResource;

class ProductController extends Controller
{
    use ImageUpload;
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
        if ($request->file('thumbnail_image')) {
            $filename = $this->imageUpload($request->image, 148, 177, 'uploads/ProductThumbnail/');
            $product->thumbnail_image ='uploads/ProductThumbnail/'.$filename;
            $product->save();
        }
        if ($request->hasFile('productImages')) {
            $productImages = $request->file('productImages');
            foreach ($productImages as $image) {
                $filename = $this->imageUpload($image, 148, 177, 'uploads/productImages/');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/productImages/'.$filename,
                ]);
            }
        }
        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }
    public function update(Request $request)
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
        if ($request->file('thumbnail_image')) {
            $this->deleteOne('uploads/ProductThumbnail/', $product->image);
            $filename = $this->imageUpload($request->image, 148, 177, 'uploads/ProductThumbnail/');
            $product->thumbnail_image ='uploads/ProductThumbnail/'.$filename;
            $product->save();
        }
        if ($request->hasFile('productImages')) {
            $productImages = $request->file('productImages');
            foreach ($productImages as $image) {
                $filename = $this->imageUpload($image, 148, 177, 'uploads/productImages/');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'uploads/productImages/'.$filename,
                ]);
            }
        }
        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    public function deleteImage($id){
        $image=ProductImage::find($id);
        $this->deleteOne('uploads/productImages/', $image->image);
        $image->delete();
        return redirect()->route('admin.product.index')->with('success', 'Image Delete successfully.');
    }
    public function changePublish($id){
        $product=Product::find($id);
        $product->published = $product->published == 1 ? 0 : 1;
        $product->save();
        return redirect()->back();
    }
}
