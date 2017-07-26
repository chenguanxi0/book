@extends('master')
@section('title',$Category->name)

@section('content')
    <div class="weui_cells weui_cells_access">


        @foreach($products as $product)
            <a class="weui_cell" href="/product/{{$product->id}}">
                <div class="weui_cell_hd"><img class="bk_preview" src="{{$product->preview}}" alt="" style="margin-right:5px;display:block"></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <div>
                    <span class="bk_title">{{$product->name}}</span>
                    <span class="bk_price" style="float: right">￥{{$product->price}}</span>
                    </div>
                    <p class="bk_summary">{{str_limit($product->summary, $limit = 50, $end = '...')}}</p>
                </div>
                <div class="weui_cell_ft"></div>
            </a>
        @endforeach

    </div>
@endsection()

@section('my-js')
    
@endsection()