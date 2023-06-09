@extends('layouts.home')

@section('title')
    Chi tiết đơn hàng 
@endsection

@section('home')
<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-main-container em-col2-left-layout">
                @if(isset($order) && isset($order_detail) && isset($success))
                    <div class="row">
                        <div class="col-sm-14 em-col-main">
                            <div id="checkout-progress-wrapper">
                                <div class="block block-progress opc-block-progress em-line-01">
                                    <div class="em-block-title block-title" style="background-color : #f9f9f9; padding-top : 15px; padding-left : 5px;"> 
                                        <strong><span>Chi tiết đơn hàng</span></strong>
                                    </div>
                                    <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                        <div class="col-sm-16">
                                            <strong><span style="text-transform : uppercase;">Sản phẩm</span></strong>
                                        </div>
                                        <div class="col-sm-8">
                                            <strong><span style="text-transform : uppercase;">Tổng cộng</span></strong>
                                        </div>
                                    </div>
                                        <div class="block-content">
                                            @foreach($order_detail as $item)
                                            <div class="row" style="padding-left : 5px; padding-top : 15px; padding-bottom : 15px; border-bottom: 1px solid #ececec;">
                                                <div class="col-sm-16">
                                                    <p style="font-size : 14px; color:#666;">{{$item->name}}<strong><span> x {{$item->quantity}}</span></strong></p>
                                                </div>
                                                <div class="col-sm-8">
                                                <p style="font-size : 14px; color:#666;">{{number_format($item->price_sale*$item->quantity*1000 ,0 ,'.' ,'.')}} VND</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @if($order->promotion > 0)
                                            <div class="block-content" style="padding-top : 15px; padding-bottom : 20px; border-bottom: 1px solid #ececec;">
                                                <div class="col-sm-16">
                                                    <span>Hưởng khuyến mại :</span>
                                                </div>
                                                <div class="col-sm-8" style="padding-left: 5%;">
                                                    <span><i class="fa fa-check" style="color : #288808;"></i></span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($order->score_awards > 0)
                                        <div class="block-content" style="padding-top : 15px; padding-bottom : 20px; border-bottom: 1px solid #ececec;">
                                            <div class="col-sm-16">
                                                <span>Đã thanh toán bằng điểm :</span>
                                            </div>
                                            <div class="col-sm-8">
                                                <span style="color : #ff0202;">{{number_format($order->score_awards*1000 ,0 ,'.' ,'.')}} VND</span>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="block-content" style="padding-top : 20px; padding-bottom : 20px;">
                                            <div class="col-sm-16">
                                                <strong><span>Thanh toán tiền mặt :</span></strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <strong><span style="color : #ff0202;">{{number_format($order->amount*1000 ,0 ,'.' ,'.')}} VND</span></strong>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10 em-sidebar">
                        <div id="checkout-progress-wrapper">
                                <div class="block block-progress opc-block-progress em-line-01">
                                    <div class="em-block-title block-title" style="background-color : #f9f9f9;"> 
                                        <strong><span>Thông tin</span></strong>
                                    </div>
                                    <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                        <div class="alert" style="background-color:#34e607; border-color: ##5bff47; color: #fffefe;">
                                            <ul><i class="fa fa-check"></i> {{$success}}</ul>
                                        </div>
                                    </div>
                                    <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                        <div class="col-sm-12">
                                            <strong><span>Mã đơn hàng</span></strong>
                                        </div>
                                        <div class="col-sm-12">
                                            <strong><span>#{{$order->order_id}}</span></strong>
                                        </div>
                                    </div>
                                    <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                        <div class="col-sm-12">
                                            <strong><span>Thời gian đặt hàng</span></strong>
                                        </div>
                                        <div class="col-sm-12">
                                            <strong><span>{{$order->created_at}}</span></strong>
                                        </div>
                                    </div>
                                    <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                        <div class="col-sm-12">
                                            <strong><span>Tổng cộng</span></strong>
                                        </div>
                                        <div class="col-sm-12">
                                            <strong><span>{{number_format($order->amount*1000 ,0 ,'.' ,'.')}} VND</span></strong>
                                        </div>
                                    </div>
                                    <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                        <div class="col-sm-12">
                                            <strong><span>Phương thức thanh toán</span></strong>
                                        </div>
                                        <div class="col-sm-12">
                                            <strong><span>Thanh toán tiền mặt</span></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.em-sidebar -->
                    </div>
                @else
                    <div style="text-align: center; margin-bottom: 50px; box-sizing : border-box;">
                        <img src="{{url('/images/shopping-cart/checkout-is-not-available.gif')}}" style="max-width : 300px;">
                    </div>
                    <div class="page-title" style="text-align: center; margin-top: 10px;">
                        <p style="font-size: 13px; color : #9c9c9c; font-weight: bold;">
                            Checkout is not available whilst your cart is empty.
                        </p>
                    </div>
                    <div style="text-align: center; margin-bottom: 20px;">
                        <a href="{{ url('/') }}" class="button-continue">
                            <span><span>Quay lại cửa hàng</span></span>
                        </a>
                    </div>
                @endif
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div>

@endsection
