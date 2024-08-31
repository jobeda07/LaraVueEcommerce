<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Inertia\Inertia;
use App\Models\Product;
use App\Helper\CartHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    // public function index(){
    //    return Inertia::render('Frontend/Cart/Cart');
    // }
    public function index(Request $request, Product $product)
    {
        $user = $request->user();
        if ($user) {
            $cartItems = Cart::where('user_id', $user->id)->get();
           // $userAddress = UserAddress::where('user_id', $user->id)->where('isMain', 1)->first();
            if ($cartItems->count() > 0) {
                return Inertia::render(
                    'Frontend/Cart/Cart',
                    [
                        'cartItems' => $cartItems,
                       // 'userAddress' => $userAddress
                    ]
                );
            }else {
                return redirect()->back();
            }  
        }
        else {
            $cartItems = CartHelper::getCookieCartItems();
            //dd($cartItems);
            if (count($cartItems) > 0) {
                $cartItems = new CartResource(CartHelper::getProductsAndCartItems());
                return  Inertia::render('Frontend/Cart/Cart', ['cartItems' => $cartItems]);
            } else {
                return redirect()->back();
            }
        }
    }
    public function store(Request $request , $id){
      // dd($request);
       $quantity=$request->post('quantity',1);
       $user=$request->user();
       if($user){
            $cartItem=Cart::where(['user_id'=>$user->id,'product_id'=>$id])->first();
            if($cartItem){
                $cartItem->increment('quantity');
            }else{
                $cart=new Cart();
                $cart->user_id=$user->id;
                $cart->product_id=$id;
                $cart->quantity=1;
                $cart->save();
            }
         } else {
            $cartItems = CartHelper::getCookieCartItems();
            $isProductExists = false;
            foreach ($cartItems as $item) {
                if ($item['product_id'] === $id) {
                    $item['quantity'] += $quantity;
                    $isProductExists = true;
                    break;
                }
            }

            if (!$isProductExists) {
                $cartItems[] = [
                    'user_id' => null,
                    'product_id' => $id,
                    'quantity' => $quantity,
                ];
            }
            CartHelper::setCookieCartItems($cartItems);
        }

        return redirect()->back()->with('success', 'cart added successfully');
    }

     public function update(Request $request, Product $product)
    {
        $quantity = $request->integer('quantity');
        $user = $request->user();
        if ($user) {
            Cart::where(['user_id' => $user->id, 'product_id' => $product->id])->update(['quantity' => $quantity]);
        } else {
            $cartItems = CartHelper::getCookieCartItems();
            foreach ($cartItems as &$item) {
                if ($item['product_id'] === $product->id) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }
            CartHelper::setCookieCartItems($cartItems);
        }

        return redirect()->back();
    }
    public function delete(Request $request, Product $product)
    {
        $user = $request->user();
        if ($user) {
            Cart::query()->where(['user_id' => $user->id, 'product_id' => $product->id])->first()?->delete();
            if (Cart::count() <= 0) {
                return redirect()->route('home')->with('info', 'your cart is empty');
            } else {
                return redirect()->back()->with('success', 'item removed successfully');
            }
        } else {
            $cartItems = CartHelper::getCookieCartItems();
            foreach ($cartItems as $i => &$item) {
                if ($item['product_id'] === $product->id) {
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            CartHelper::setCookieCartItems($cartItems);
            if (count($cartItems) <= 0) {
                return redirect()->route('home')->with('info', 'your cart is empty');
            } else {
                return redirect()->back()->with('success', 'item removed successfully');
            }
        }
    }
}
