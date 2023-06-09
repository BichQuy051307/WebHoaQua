@extends('layouts.home')

@section('title')
Giỏ hàng 
@endsection

@section('js')
<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
@endsection

@section('home')
<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-wrapper-area02"></div>
            <div class="em-main-container em-col1-layout">
                <div class="row">
                    <div class="em-col-main col-sm-24">
                        @if(isset($limit))
                        <div class="alert" style="background-color:#f40e03; border-color: #03A9F4; color: #fffefe;">
                            <ul><i class="fa fa-exclamation-triangle"></i> {{$limit}}</ul>
                        </div>
                        @endif
                        <div class="cart">
                            <div class="page-title title-buttons">
                                <ul class="checkout-types">
                                    <li>
                                        <button type="button" title="Proceed to Checkout"
                                            class="button btn-proceed-checkout btn-checkout"><span><span>Proceed to
                                                    Checkout</span></span>
                                        </button>
                                    </li>
                                </ul>
                            </div><!-- /.page-title -->
                            <form method="post">
                                @csrf
                                <input name="form_key" type="hidden" value="inYgLvzSpOOWWVoP" />
                                <fieldset>
                                    @if(isset($data))
                                    @if($data)
                                    <table id="shopping-cart-table" class="data-table cart-table">
                                        <thead>
                                            <tr class="em-block-title">
                                                <th><span class="nobr">Sản phẩm</span>
                                                </th>
                                                <th>&nbsp;</th>
                                                <th class="a-center" colspan="1"><span class="nobr">Giá</span>
                                                </th>
                                                <th class="a-center">Số lượng</th>
                                                <th class="a-center last" colspan="1">Tổng cộng</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $subtotal = 0; ?>
                                            @foreach($data as $id => $item)
                                            <?php 
                                                        $subtotal += $item['price_sale'] * $item['qty'];
                                                    ?>
                                            <tr class="first odd">
                                                <td>
                                                    <div class="cart-product"
                                                        style="width : 100px; height : 150px; box-sizing : border-box;">
                                                        <button type="button" data-id={{$id}} title="Xóa"
                                                            class="btn-remove btn-remove2 remove-cart">Xóa sản
                                                            phẩm</button>
                                                        <a href="{{ url('/san-pham/'.$item['slug']) }}">
                                                            <img src="{{asset('images/products/'.$item['image'])}}"
                                                                alt="{{$item['name']}}"
                                                                style="width : 100%; height : auto;" />
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ url('/san-pham/'.$item['slug']) }}"
                                                        style="color : #1b74e7; font-size: 14px;"> {{$item['name']}}
                                                    </a>
                                                    <p class="sku" style="color : #111; font-size: 12px;">
                                                        {{$item['code']}}</p>
                                                </td>

                                                <td class="a-center"> <span class="cart-price">
                                                        <span class="price">{{number_format($item['price_sale']*1000 ,0
                                                            ,'.' ,'.')}} VND</span>
                                                </td>
                                                <td class="a-center">
                                                    <div class="qty_cart">
                                                        <div class="qty-ctl">
                                                            <button data-id="{{$id}}" type="button"
                                                                class="decrease btn-decrement"></button>
                                                        </div>
                                                        <input value="{{$item['qty']}}" size="4" class="input-text qty"
                                                            maxlength="12" disabled />
                                                        <div class="qty-ctl">
                                                            <button data-id="{{$id}}" type="button"
                                                                class="increase btn-increment"></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="a-center last">
                                                    <span class="cart-price">
                                                        <span class="price">
                                                            {{number_format($item['price_sale']*$item['qty']*1000 ,0
                                                            ,'.' ,'.')}} VND
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="7" class="a-left">
                                                    <a href="{{ url('/') }}" class="button-continue">
                                                        <span><span>Tiếp tục mua hàng</span></span>
                                                    </a>

                                                    <button type="button" class="button-continue btn-empty">
                                                        <span><span>Làm trống giỏ hàng</span></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @else
                                    <div class="page-title" style="text-align: center; margin-top: 10px;">
                                        <p style="font-size: 16px; color: red; font-weight: bold;  font-style: italic;">
                                            Giỏ hàng của bạn đang trống. Mời bạn tiếp tục mua hàng!
                                        </p>
                                    </div>
                                    <div style="text-align: center; box-sizing:border-box;">
                                        <img src="{{url('/images/shopping-cart/checkout-is-not-available.gif')}}"
                                            style="max-width : 320px;">
                                    </div>
                                    <div style="text-align: center; margin-bottom: 20px;">
                                        <a href="{{ url('/') }}" class="button-continue">
                                            <span><span>Tiếp tục mua hàng</span></span>
                                        </a>
                                    </div>
                                    @endif
                                    @endif
                                </fieldset>
                            </form><!-- /form -->

                            @if(isset($data))
                            @if($data)
                            <div class="cart-collaterals row">
                                <div class="first totals col-md-8 col-sm-24">
                                    <form id="discount-coupon-form" method="post">
                                        <div class="discount em-box-cart">
                                            <div class="discount-form em-box">
                                                <label for="coupon_code">Nhập mã ưu đãi</label>
                                                <input type="hidden" name="remove" id="remove-coupone" value="0" />
                                                <div class="input-box">
                                                    <input class="input-text" id="coupon_code" name="coupon_code"
                                                        value="" />
                                                </div>
                                                <div class="buttons-set">
                                                    <button type="button" class="button"
                                                        onclick="discountForm.submit(false)" value="Apply Coupon">
                                                        <span><span>Áp dụng</span></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.col-sm-24 -->

                                <div class="last totals col-md-16 col-sm-24 right">
                                    <div class="em-box-cart">
                                        <div class="em-box">
                                            <table id="shopping-cart-totals-table" style="width : 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="color : #696868; width : 30%;"> Tạm tính : </td>
                                                        <td>
                                                            <p style="color : #111; width : 70%; text-align: right;">
                                                                {{number_format($subtotal*1000 ,0 ,'.' ,'.')}} VND</p>
                                                        </td>
                                                    </tr>
                                                    @if(isset($promotion))
                                                    @if($subtotal >= $promotion->amount)
                                                    <tr>
                                                        <td style="color : #696868; width : 30%;"> Chương trình khuyến
                                                            mại : </td>
                                                        <td>
                                                            <p style="color : #111; width : 70%; text-align: right;">
                                                                {{$promotion->discount}} %</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="color : #111; font-weight : 600; width : 30%; font-size : 18px;">
                                                            Thành tiền : </td>
                                                        <td>
                                                            <p
                                                                style="color : #ea000f; width : 70%; text-align: right; font-size : 18px;">
                                                                {{number_format(ceil(($subtotal -
                                                                $subtotal*$promotion->discount/100))*1000 ,0 ,'.'
                                                                ,'.')}} VND</p>
                                                            <p
                                                                style="color : #696868; width : 70%; text-align: right; font-size : 14px;">
                                                                (Đã bao gồm VAT) </p>
                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td
                                                            style="color : #111; font-weight : 600; width : 30%; font-size : 18px;">
                                                            Thành tiền : </td>
                                                        <td>
                                                            <p
                                                                style="color : #ea000f; width : 70%; text-align: right; font-size : 18px;">
                                                                {{number_format($subtotal*1000 ,0 ,'.' ,'.')}} VND</p>
                                                            <p
                                                                style="color : #696868; width : 70%; text-align: right; font-size : 14px;">
                                                                (Đã bao gồm VAT) </p>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @else
                                                    <tr>
                                                        <td
                                                            style="color : #111; font-weight : 600; width : 30%; font-size : 18px;">
                                                            Thành tiền : </td>
                                                        <td>
                                                            <p
                                                                style="color : #ea000f; width : 70%; text-align: right; font-size : 18px;">
                                                                {{number_format($subtotal*1000 ,0 ,'.' ,'.')}} VND</p>
                                                            <p
                                                                style="color : #696868; width : 70%; text-align: right; font-size : 14px;">
                                                                (Đã bao gồm VAT) </p>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <ul class="checkout-types">
                                                <li>
                                                    <button type="button" class="button btn-checkout"
                                                        style="font-weight : 500;">
                                                        <span><span>Tiến hành đặt hàng</span></span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- /.em-box-cart -->
                                </div><!-- /.last -->
                            </div><!-- /.cart-collaterals -->
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div><!-- /.em-wrapper-main -->

<script type="text/javascript">
    //increment
    $('.btn-increment').click(function () {
        var id = $(this).attr('data-id');
        var count = Number($(".em-topcart-qty").html());
        $.ajax({
            type: "post",
            url: "/increment/cart",
            data: {
                _token: $('[name="_token"]').val(),
                id: id,
            },
            success: function (response) {
                if(response.is === 'failed'){
                    swal({
                        title: "Lỗi!",
                        text: response.message,
                        icon: "error",
                        buttons: true,
                        dangerMode: true,
                        buttons: ["Tiếp tục mua hàng", "Hủy"],
                    })
                }
                else{
                    window.location.reload();
                }
                
            }
        });
    });

    //decrement
    $('.btn-decrement').click(function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "/decrement/cart",
            data: {
                _token: $('[name="_token"]').val(),
                id: id,
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });

    $(".remove-cart").click(function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "delete",
            url: "/remove-cart/" + id,
            data: {
                _token: $('[name="_token"]').val(),
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });

    $('.btn-empty').click(function () {
        swal({
            title: "Bạn chắc chắn?",
            text: "Xóa toàn bộ sản phẩm trong giỏ hàng!",
            icon: "error",
            buttons: true,
            dangerMode: true,
            buttons: ["Hủy", "Đồng ý"],
        })
            .then(willDelete => {
                if (willDelete) {
                    $.ajax({
                        type: 'get',
                        url: '/clear/cart/',
                        data: {
                            _token: $('[name="_token"]').val(),
                        },
                        success: function (response) {
                            swal({
                                title: "Đã xóa!",
                                text: "Toàn bộ sản phẩm trong giỏ hàng đã bị xóa!",
                                icon: "success",
                                buttons: true,
                                buttons: ["Ok"],
                                timer: 1500
                            });
                            setTimeout(function () {
                                window.location.href = "/checkout/cart";
                            }, 1600);
                        }
                    });
                }
            })
    });

    $('.btn-checkout').click(function () {
        window.location.href = "/checkout/payment";
    });
</script>
@endsection