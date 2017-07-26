<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Model\M3Result;

class BookController extends Controller
{
    public function toCategory($parent_id)
    {
        $categorys = Category::where('parent_id',$parent_id)->get();

        $M3Result = new M3Result;
        $M3Result->status = 0;
        $M3Result->message = '返回成功';
        $M3Result->categorys = $categorys;
        return $M3Result->toJson();
    }

}
