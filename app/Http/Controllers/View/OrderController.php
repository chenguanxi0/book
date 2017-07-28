<?php

namespace App\Http\Controllers\View;

use App\Entity\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Cart_Item;
use App\Model\M3Result;

class OrderController extends Controller
{
      public function toOrderPay(Request $request)
      {

          $product_ids = $request->input('product_ids');
          $member = $request->session()->get('member');
//          如果数据库中有该用户购物车数据  即查数据库中该用户的购物车数据 合并
           $Cart_Items = Cart_Item::where('member_id',$member->id)->get();




          $product_id_arr = explode(',',$product_ids); //1=>1,2=>3,3=>2   这是客户端传递过来的ID
          $bk_cart = $request->cookie('bk_cart');

          $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array()); //1=>2:1,2=>1:1,3=>3:1,4=>4:1

//          如果没有  直接提交
          $order_pdt = array();
          $pdt_count = array();
          if (count($Cart_Items) == 0){
              foreach ($bk_cart_arr as $key=>$value) {
                  $index = strpos($value, ':');
                  $product_id = substr($value,0,$index); //2,1,3,4 cookie中的ID
                  $count = substr($value,$index+1);

                  if(in_array($product_id,$product_id_arr)){

                      unset($bk_cart_arr[$key]);
                      $order_pdt[$key] = Product::where('id',$product_id)->first();
                      $pdt_count[$key] = $count;
                  }

              }





              return response()->view('order_pay',['order_pdt'=>$order_pdt,'pdt_count'=>$pdt_count])->cookie('bk_cart',implode(',',$bk_cart_arr));
          }else{  //数据库有内容 直接合并

                  $cart_nohave = array();
              foreach ($Cart_Items as $Cart_Item){


              foreach ($bk_cart_arr as $key=>&$value) {

                  $index = strpos($value, ':');
                  $product_id = substr($value,0,$index); //2,1,3,4 cookie中的ID
                  $count = substr($value,$index+1);


                  if($Cart_Item->product_id == $product_id){  //如果数据库中的ID 在cookie中也存在 直接在cookie中添加数量
                      $count = $count + $Cart_Item->count;
                      echo $product_id;
                  }else{
//                         echo $Cart_Item->product_id.':'.$Cart_Item->count;
                      array_push($cart_nohave,$Cart_Item->product_id.':'.$Cart_Item->count);
                  }




                  if(in_array($product_id,$product_id_arr)){ //

                      unset($bk_cart_arr[$key]);
                      $order_pdt[$key] = Product::where('id',$product_id)->first();
                      $pdt_count[$key] = $count;
                  }

              }}
                dd($cart_nohave);
              $bk_cart_arr =  array_merge($cart_nohave,$bk_cart_arr);
              return response()->view('order_pay',['order_pdt'=>$order_pdt,'pdt_count'=>$pdt_count])->cookie('bk_cart',implode(',',$bk_cart_arr));

          }


             return view('order_pay');
      }
}