<?php

namespace App\Helper;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;

Class CartHelper
{
    public static function getCount():int
    {
        if($user  = auth()->user()){
          return Cart::whereUserId($user->id)->count();
        }else{
           return array_reduce(self::getCookieCartItems(),fn ($carry) =>$carry +1,0);
        }
    }
    public static function getCartItems(){
        if($user = auth()->user()){
            return Cart::whereUserId($user->id)->get()->map(fn (Cart $item) =>['product_id' =>$item->product_id,'quantity'=>$item->quantity]);
        }else{
            return self::getCookieCartItems();
        }
    }

    public static function getCookieCartItems(){
        return json_decode(request()->cookie('cart_items','[]'),true);
    }
    public static function setCookieCartItems(array $cartItems)
    {
        Cookie::queue('cart_items', json_encode($cartItems), 60*24*30);
    }
    public static function saveCookieCartItems(){
        $user=auth()->user();
        $userCartItems=Cart::where(['user_id'=>$user->id])->get()->keyBy('product_id');
        $savedCartItems =[];
        foreach(self::getCookieCartItems() as $cartItem){
            if(isset($userCartItems[$cartItem['product_id']])){
                $userCartItems[$cartItem['product_id']]->update(['quantity'=>$cartItem['quantity']]);
                continue;
            }
            $savedCartItems[]=[
                'user_id' =>$user->id,
                'product_id'=>$cartItem['product_id'],
                'quantity'=>$cartItem['quantity'],
            ];
        }
        if(!empty($savedCartItems)){
            Cart::insert($savedCartItems);
        }
    }

    public static function moveCartItemsIntoDb()
    {
        $request = request();
        $cartItems = self::getCookieCartItems();
        $newCartItems = [];
        foreach ($cartItems as $cartItem) {
            // Check if the record already exists in the database
            $existingCartItem = Cart::where([
                'user_id' => $request->user()->id,
                'product_id' => $cartItem['product_id'],
            ])->first();

            if (!$existingCartItem) {
                // Only insert if it doesn't already exist
                $newCartItems[] = [
                    'user_id' => $request->user()->id,
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quantity'],
                ];
            }
        }


        if (!empty($newCartItems)) {
            // Insert the new cart items into the database
            Cart::insert($newCartItems);
        }
    }


    public static function getProductsAndCartItems()
    {
        $cartItems = self::getCartItems();
        $ids = Arr::pluck($cartItems, 'product_id');
        $products = Product::whereIn('id', $ids)->with('productAllImages')->get();
        $cartItems = Arr::keyBy($cartItems, 'product_id');
        return [$products, $cartItems];
    }
    //
}
