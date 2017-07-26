<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Pdt_Content;
use App\Entity\Pdt_Images;

class BookController extends Controller
{
//    分类页
    public function toCategory()
    {
        $categorys = Category::whereNull('parent_id')->get();
        return view('category')->with('categorys',$categorys);
    }

//    列表页
    public function toProduct($category_id)
    {
        $products = Product::where('category_id',$category_id)->get();
        $Category = Category::where('id',$category_id)->first();
       return view('product')->with('products',$products)->with('Category',$Category);
    }

//    详情页
    public function toPdtContent(Request $request,$product_id)
    {
        $product = Product::where('id',$product_id)->first();

        //pdt_content
           $Pdt_Content = Pdt_Content::where('product_id',$product_id)->first();
        //pdt_images
           $pdt_images = Pdt_Images::where('product_id',$product_id)->get();


        $bk_cart = $request->cookie('bk_cart');

        $bk_cart_arr = ($bk_cart!=null ? explode(',', $bk_cart) : array());

        $count = 0;

        foreach ($bk_cart_arr as $value) {   // 一定要传引用
            $index = strpos($value, ':');
            if(substr($value, 0, $index) == $product_id) {
                $count = (int) substr($value, $index+1);
                $value = $product_id . ':' . $count;
                break;
            }
        }


        return view('pdt_content')->with('product',$product)
                                  ->with('Pdt_Content',$Pdt_Content)
                                  ->with('pdt_images',$pdt_images)
                                  ->with('count',$count);

    }
}
