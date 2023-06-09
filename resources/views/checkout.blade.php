@extends('layouts.home')

@section('title')
    Thanh toán 
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/upload.css')}}">
@endsection

@section('js')
<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
@endsection

@section('home')
@if(isset($orders))
    <?php $subtotal = 0; ?>
    @foreach($orders as $order)
        <?php 
            $subtotal += $order->price_sale * $order->quantity;
        ?>
    @endforeach
@endif
<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-main-container em-col2-left-layout">
                @if(isset($orders) && isset($order_id))
                    <div class="row">
                        <div class="col-sm-14 em-col-main">
                            <ol class="opc" id="checkoutSteps">
                                <li id="opc-billing" class="section allow">
                                    <div class="em-box-02 step-title" data-toggle="collapse" data-target="#checkout-step-billing">
                                        <div class="title-box" style="background : #fff;"> <span class="number">1</span>
                                            <h2 style="color : black; text-transform: uppercase;">Thông tin thanh toán</h2> 
                                        </div>
                                    </div>
                                    <div id="checkout-step-billing" class="step a-item collapse in">
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert" style="background-color: #FF9800; border-color: #fb052d;color: #fffefe;">
                                                    <ul><i class="fa fa-exclamation-triangle"></i> {{$error}}</ul>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if(Auth::check())
                                        <form id="co-billing-form" action="{{ url('/checkout/payment') }}" method="post" enctype="multipart/form-data">
                                            @csrf   
                                                <fieldset>
                                                    <ul class="form-list">
                                                        <li id="billing-new-address-form">
                                                            <fieldset>
                                                                <ul>
                                                                    <li class="wide">
                                                                        <label for="name" class="required"><em>*</em>Tên khách hàng</label>
                                                                        <div class="input-box">
                                                                            <input type="text" name="name" id="getName" class="input-text form-control" value="{{Auth::user()->name}}" disabled/>
                                                                            <input type="hidden" name="name" id="getName" class="input-text form-control" value="{{Auth::user()->name}}"/>
                                                                            <input type="hidden" name="score_awards_payment" id="score_awards_payment" class="input-text form-control" value="0"/>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="phone" class="required"><em>*</em>Số điện thoại</label>
                                                                        <div class="input-box">
                                                                            <input type="text" name="phone" id="getPhone" class="input-text" value="{{ old('phone') }}"/>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="email" class="required">Email</label>
                                                                        <div class="input-box">
                                                                            <input type="text" name="email" id="getEmail" class="input-text form-control" value="{{Auth::user()->email}}" disabled/>
                                                                            <input type="hidden" name="email" id="getEmail" class="input-text form-control" value="{{Auth::user()->email}}"/>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="address" class="required"><em>*</em>Địa chỉ giao hàng</label>
                                                                        <div class="input-box">
                                                                            <textarea name="address" class="form-control" id="getAddress" style="width: 100%; height : 80px; color: #111; font-size: 16px; line-height : 30px;">{{Auth::user()->address}}</textarea><br>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="note" class="required">Ghi chú cho đơn hàng</label>
                                                                        <div class="input-box">
                                                                            <textarea name="note" class="form-control" id="getNote" style="width: 100%; height : 100px; color: #111; font-size: 16px; line-height : 30px;"></textarea><br>
                                                                        </div>
                                                                    </li>
                                                                    
                                                                    <input id="getUserId" type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                                                                    <input id="getAmount" type="hidden" name="amount" value="{{$subtotal}}" class="form-control"> 
                                                                    <input id="getOrderId" type="hidden" name="order_id" value="{{$order_id}}" class="form-control"> 
                                                                </ul>
                                                            </fieldset>
                                                        </li>
                                                    </ul>
                                                    <div class="buttons-set" id="billing-buttons-container">
                                                        <button type="submit" class="button btn-checkout" style="width: 100%; height: 50px; font-size: 14px;"
                                                        id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý">
                                                            Đặt mua
                                                        </button>
                                                        <p class="required" style="font-size : 12px;">(Xin vui lòng kiểm tra lại đơn hàng trước khi Đặt Mua)</p>
                                                    </div>
                                                    
                                                </fieldset>
                                            </form>
                                        @else
                                            <form id="co-billing-form" action="{{ url('/checkout/payment') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <fieldset>
                                                    <ul class="form-list">
                                                        <li id="billing-new-address-form">
                                                            <fieldset>
                                                                <ul>
                                                                    <li class="wide">
                                                                        <label for="name" class="required"><em>*</em>Tên khách hàng</label>
                                                                        <div class="input-box">
                                                                            <input type="text" name="name" id="getName" class="input-text" value="{{ old('name') }}"/>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="phone" class="required">Số điện thoại</label>
                                                                        <div class="input-box">
                                                                            <input type="text" name="phone" id="getPhone" class="input-text" value="{{ old('phone') }}"/>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="email">Email (Không bắt buộc)</label>
                                                                        <div class="input-box">
                                                                            <input type="text" name="email" id="getEmail" class="input-text" value="{{ old('email') }}"/>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="address" class="required"><em>*</em>Địa chỉ giao hàng</label>
                                                                        <div class="input-box">
                                                                            <textarea name="address" class="form-control" id="getAddress" style="width: 100%; height : 60px;" value="{{ old('address') }}"></textarea><br>
                                                                        </div>
                                                                    </li>
                                                                    <li class="wide">
                                                                        <label for="email" class="required">Ghi chú cho đơn hàng (Không bắt buộc)</label>
                                                                        <div class="input-box">
                                                                            <textarea name="note" class="form-control" id="getNote" style="width: 100%; height : 100px;" value="{{ old('note') }}"></textarea><br>
                                                                        </div>
                                                                    </li>
                                                                    <input id="getAmount" type="hidden" name="amount" value="{{$subtotal}}" class="form-control"> 
                                                                    <input id="getOrderId" type="hidden" name="order_id" value="{{$order_id}}" class="form-control"> 
                                                                </ul>
                                                            </fieldset>
                                                        </li>
                                                    </ul>
                                                    <div class="buttons-set" id="billing-buttons-container">
                                                        <button type="submit" class="button btn-checkout" style="width: 100%; height: 50px; font-size: 14px;"
                                                        id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Đang xử lý">
                                                            Đặt mua
                                                        </button>
                                                        <p class="required" style="font-size : 12px;">(Xin vui lòng kiểm tra lại đơn hàng trước khi Đặt Mua)</p>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        @endif
                                    </div><!-- /#checkout-step-billing -->
                                </li><!-- /#opc-billing -->
                            </ol>
                        </div>
                        <div class="col-sm-10 em-sidebar">
                            <div id="checkout-progress-wrapper">
                                <div class="block block-progress opc-block-progress em-line-01">
                                    <div class="em-block-title block-title" style="background-color : #f9f9f9;"> 
                                        <strong><span>Đơn hàng của bạn</span></strong>
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
                                            <?php $subtotal = 0; ?>
                                            @foreach($orders as $order)
                                            <?php 
                                                $subtotal += $order->price_sale * $order->quantity;
                                            ?>
                                            <div class="row" style="padding-top : 15px; padding-bottom : 15px; border-bottom: 1px solid #ececec;">
                                                <div class="col-sm-16">
                                                    <p style="font-size : 14px; color:#666;">{{$order->name}}<strong><span> x {{$order->quantity}}</span></strong></p>
                                                </div>
                                                <div class="col-sm-8">
                                                <p style="font-size : 14px; color:#666;">{{number_format($order->price_sale*$order->quantity*1000 ,0 ,'.' ,'.')}} VND</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                            <div class="col-sm-16">
                                                <span>Tạm tính :</span>
                                            </div>
                                            <div class="col-sm-8">
                                                <span>{{number_format($subtotal*1000 ,0 ,'.' ,'.')}} VND</span>
                                            </div>
                                        </div>
                                        @if(isset($promotion))
                                            @if($subtotal >= $promotion->amount)
                                            <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                                <div class="col-sm-16">
                                                    <span>Chương trình khuyến mãi :</span>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span>{{$promotion->discount}} %</span>
                                                </div>
                                            </div>
                                            <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                                <div class="col-sm-16">
                                                    <strong><span>Thành tiền :</span></strong>
                                                </div>
                                                <div class="col-sm-8">
                                                    <strong><span style="color : #ff0202;">{{number_format(ceil(($subtotal - $subtotal*$promotion->discount/100))*1000 ,0 ,'.' ,'.')}} VND</span></strong>
                                                    <p style="color : #333; font-size: 12px;">(Đã bao gồm VAT)</p>
                                                </div>
                                                <br>
                                                <div class="col-sm-24">
                                                    <p style="font-size: 13px; text-align:center;">(Chưa bao gồm phí vận chuyển. Xem thông tin <a target="_blank" href="{{url('/phuong-thuc-van-chuyen')}}" style="color: #00ab9f !important; font-weight:600 !important;">chi phí vận chuyển</a> )</p>
                                                </div>
                                            </div>
                                            @else
                                                <div class="block-content" style="border-bottom: 1px solid #ececec;">
                                                    <div class="col-sm-16" style="padding-top:18px !important;">
                                                        <strong><span>Thành tiền :</span></strong>
                                                    </div>
                                                    <div class="col-sm-8" style="padding-top:18px !important;">
                                                        <strong><span style="color : #ff0202;">{{number_format($subtotal*1000 ,0 ,'.' ,'.')}} VND</span></strong>
                                                        <p style="color : #333; font-size: 12px;">(Đã bao gồm VAT)</p>
                                                    </div>
                                                    <br>
                                                    <div class="col-sm-24">
                                                        <p style="font-size: 13.5px; text-align:center;">(Chưa bao gồm phí vận chuyển. Xem thông tin <a target="_blank" href="{{url('/phuong-thuc-van-chuyen')}}" style="color: #00ab9f !important; font-weight:600 !important;">chi phí vận chuyển</a> )</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="block-content" style="margin-top: 20px; border-bottom: 1px solid #ececec;">
                                                <div class="col-sm-16">
                                                    <strong><span>Thành tiền :</span></strong>
                                                </div>
                                                <div class="col-sm-8">
                                                    <strong><span style="color : #ff0202;">{{number_format($subtotal*1000 ,0 ,'.' ,'.')}} VND</span></strong>
                                                    <p style="color : #333; font-size: 12px;">(Đã bao gồm VAT)</p>
                                                </div>
                                                <br>
                                                <div class="col-sm-24">
                                                    <p style="font-size: 13.5px; text-align:center;">(Chưa bao gồm phí vận chuyển. Xem thông tin <a target="_blank" href="{{url('/phuong-thuc-van-chuyen')}}" style="color: #00ab9f !important; font-weight:600 !important;">chi phí vận chuyển</a> )</p>
                                                </div>
                                            </div>
                                        @endif
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

<script>
    $('.btn-checkout').on('click', function() {
        var $this = $(this);
        $this.button('loading');
            setTimeout(function() {
            $this.button('reset');
        }, 3000);
    });
</script>

<script>
    var flag = false;
    $(document).ready(function () {
        $('.btn-add-files').click(function() {
            $('.file-input').last().trigger('click');
        });
    });

    $(document).on('change', '.file-input', function(){
        if (this.files && this.files[0]) {
            flag = true;

            var reader = new FileReader();

            reader.onload = function (e) {
                $('#thumbnail')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            $('#preview .row .show').removeClass('hidden');

            reader.readAsDataURL(this.files[0]);
        }
    });         
    
    $('.btn-remove-image').click(function(){
        flag = false;
        $(this).parents('.show').addClass("hidden");
    });
</script>
@endsection

