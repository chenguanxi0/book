<?php

namespace App\Http\Controllers\View;

use App\Entity\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Cart_Item;

class CartController extends Controller
{
    public function toCart(Request $request)
    {
        $cart_items = array();
        $bk_cart = $request->cookie('bk_cart');

        $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());

        $count = 1;
        foreach ($bk_cart_arr as $key=>$value) {   // 一定要传引用
            $index = strpos($value, ':');
            $Cart_Item = new Cart_Item;
            $Cart_Item->id = $key;
            $Cart_Item->product_id = substr($value, 0, $index);
            $Cart_Item->count = substr($value,$index+1);
            $Cart_Item->product = Product::where('id',$Cart_Item->product_id)->first();
            if ($Cart_Item->product != null ){
                array_push($cart_items,$Cart_Item);
            }

        }
        return view('cart')->with('cart_items',$cart_items);
    }
}
