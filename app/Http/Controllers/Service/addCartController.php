<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\M3Result;
use App\Entity\Cart_Item;



class addCartController extends Controller
{
    public function addCart(Request $request,$product_id)
    {
        $bk_cart = $request->cookie('bk_cart');


        $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());

        $count = 1;
        foreach ($bk_cart_arr as &$value) {   // 一定要传引用
            $index = strpos($value, ':');
            if(substr($value, 0, $index) == $product_id) {
                $count = ((int) substr($value, $index+1)) + 1;
                $value = $product_id . ':' . $count;
                break;
            }
        }

        if ($count ==1){
            array_push($bk_cart_arr,$product_id.":".$count);
        }

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return response($m3_result->toJson())->cookie('bk_cart',implode(',',$bk_cart_arr));

    }

    public function deleteCart(Request $request)
    {
        $m3_result = new M3Result;
        $product_ids = $request->input('product_ids'); //字符串 1,3


        if($product_ids == null){

            $m3_result->status = 1;
            $m3_result->message = '产品ID不存在';
            return $m3_result->toJson();
        }
        $product_id_arr = explode(',',$product_ids); //客户端传过来的ID数组

        $bk_cart = $request->cookie('bk_cart');

        $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array()); //2:1,1:1,3:1,4:1



        foreach ($bk_cart_arr as $key=>$value) {
            $index = strpos($value, ':');
            $product_id = substr($value,0,$index);

            if(in_array($product_id,$product_id_arr)){

                array_splice($bk_cart_arr,$key,1,'0:0');

            }
        }

        foreach ($bk_cart_arr as $key=>$value){
            if ($value == '0:0'){
                unset($bk_cart_arr[$key]);
            }
        }


        $m3_result->status = 0;
        $m3_result->message = '删除成功';
        return response($m3_result->toJson())->cookie('bk_cart',implode(',',array_values($bk_cart_arr)));


    }
}
