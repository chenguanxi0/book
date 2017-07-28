@extends('master')
@section('title', '登录')

@section('content')
    @foreach($order_pdt as $key=>$order_pdts)
       {{$order_pdts}} {{$pdt_count[$key]}}
    @endforeach


    <div class="page bk_content" style="top: 0;">
        <div class="weui_cells">
            @foreach($order_pdt as $key=>$order_pdts)
                <div class="weui_cell">
                    <div class="weui_cell_hd">
                        <img src="{{$order_pdts->preview}}" alt="" class="bk_icon">
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <p class="bk_summary">{{$order_pdts->name}}</p>
                    </div>
                    <div class="weui_cell_ft">
                        <span class="bk_price">{{$order_pdts->price}}</span>
                        <span> x </span>
                        <span class="bk_important">{{$pdt_count[$key]}}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="weui_cells_title">支付方式</div>
        <div class="weui_cells">
            <div class="weui_cell weui_cell_select">
                <div class="weui_cell_bd weui_cell_primary">
                    <select class="weui_select" name="payway">
                        <option selected="" value="1">支付宝</option>
                        <option value="2">微信</option>
                    </select>
                </div>
            </div>
        </div>

        <form action="/service/alipay" id="alipay" method="post">
            {{ csrf_field() }}
            {{--<input type="hidden" name="total_price" value="{{$total_price}}" />--}}
            {{--<input type="hidden" name="name" value="{{$name}}" />--}}
            {{--<input type="hidden" name="order_no" value="{{$order_no}}" />--}}
        </form>

        <div class="weui_cells">
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>总计:</p>
                </div>
                {{--<div class="weui_cell_ft bk_price" style="font-size: 25px;">￥ {{$total_price}}</div>--}}
            </div>
        </div>
    </div>
    <div class="bk_fix_bottom">
        <div class="bk_btn_area">
            <button class="weui_btn weui_btn_primary" onclick="_onPay();">提交订单</button>
        </div>
    </div>



@endsection()

@section('my-js')

@endsection()