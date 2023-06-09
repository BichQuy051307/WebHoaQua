@extends('layouts.home') @section('title') @if(isset($product))
{{$product->name}}
@else Chi tiết sản phẩm - Product Store @endif @endsection @section('js')
<script
    type="text/javascript"
    src="{{ asset('home/js/sweetalert.min.js') }}"
></script>
@endsection @section('home') @if(isset($product)) @csrf
<div class="container-fluid container-main">
    <div class="em-inner-main">
        <div class="em-main-container em-col1-layout">
            <div class="row">
                <div class="em-col-main col-sm-22 col-sm-offset-1">
                    <div id="messages_product_view"></div>
                    <div class="product-view">
                        <div class="product-essential">
                            <form id="product_addtocart_form">
                                <div class="product-view-detail">
                                    <div class="em-product-view row">
                                        <div
                                            class="em-product-view-primary em-product-img-box col-sm-14"
                                        >
                                            <div
                                                id="em-product-shop-pos-top"
                                            ></div>
                                            <div
                                                class="product-img-box"
                                                style="text-align: center"
                                            >
                                                <div class="">
                                                    <p
                                                        class="product-image"
                                                        style="margin-top: 10px"
                                                    >
                                                        <a
                                                            class="cloud-zoom"
                                                            id="image_zoom"
                                                            rel="zoomWidth: 600, position : 'inside'"
                                                            href="{{asset('images/products/'.$product->image)}}"
                                                        >
                                                            <img
                                                                class="em-product-main-img"
                                                                src="{{asset('images/products/'.$product->image)}}"
                                                                style="
                                                                    width: 60%;
                                                                "
                                                            />
                                                        </a>
                                                    </p>
                                                </div>
                                                <!-- /.media-left -->
                                            </div>
                                        </div>
                                        <!-- /.em-product-view-primary -->
                                        <div
                                            class="em-product-shop col-sm-9"
                                            style="margin-top: 30px"
                                        >
                                            <div class="product-shop">
                                                <div id="em-product-info-basic">
                                                    <div class="product-name">
                                                        <h1
                                                            style="
                                                                font-weight: bold;
                                                                text-transform: uppercase;
                                                            "
                                                        >
                                                            {{strtoupper($product->name)}}
                                                        </h1>
                                                    </div>

                                                    <div>
                                                        <p
                                                            style="
                                                                margin-top: 10px;
                                                            "
                                                        >
                                                            Mã sản phẩm :
                                                            {{$product->code}}
                                                        </p>
                                                    </div>

                                                    <div
                                                        class="price-box"
                                                        style="margin-top: 30px"
                                                    >
                                                        @if($product->price >
                                                        $product->price_sale)
                                                        <p class="old-price">
                                                            <span
                                                                class="price"
                                                                id="old-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a"
                                                                style="
                                                                    font-weight: bold;
                                                                "
                                                            >
                                                                {{number_format($product->price*1000 ,0 ,'.' ,'.')}}
                                                                VND
                                                            </span>
                                                        </p>
                                                        @endif

                                                        <p
                                                            class="special-price"
                                                        >
                                                            <span
                                                                class="price"
                                                                content="60"
                                                                id="product-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a"
                                                                style="
                                                                    color: #00ab9f;
                                                                "
                                                            >
                                                                {{number_format($product->price_sale*1000 ,0 ,'.' ,'.')}}
                                                                VND
                                                            </span>
                                                        </p>
                                                    </div>

                                                    <div
                                                        class="short-description"
                                                        style="margin-top: 20px"
                                                    >
                                                        <div
                                                            class="sku"
                                                            style="
                                                                color: #777;
                                                                font-size: 16px;
                                                                text-align: justify;
                                                            "
                                                        >
                                                            @if(strlen($product->description)
                                                            > 500)
                                                            {!!substr($product->description,
                                                            0, 500)!!}... @else
                                                            {!!$product->description!!}
                                                            @endif
                                                        </div>

                                                        @if($product->quantity > 0)
                                                        <div
                                                            style="
                                                                width: 100px;
                                                                padding: 3px 3px;
                                                                background: #6df31a;
                                                                color: #fff;
                                                                font-weight: bold;
                                                                font-size: 12px;
                                                                text-transform: uppercase;
                                                                text-align: center;
                                                            "
                                                        >
                                                            Còn hàng
                                                        </div>
                                                        @else
                                                        <div
                                                            style="
                                                                width: 100px;
                                                                padding: 3px 3px;
                                                                background: #ff0000;
                                                                color: #fff;
                                                                font-weight: bold;
                                                                font-size: 12px;
                                                                text-transform: uppercase;
                                                                text-align: center;
                                                            "
                                                        >
                                                            Hết hàng
                                                        </div>
                                                        @endif
                                                    </div>

                                                    @if($product->quantity > 0)
                                                    <div
                                                        class="add-to-box"
                                                        style="margin-top: 30px"
                                                    >
                                                        <div class="">
                                                            <div
                                                                class="qty_cart"
                                                            >
                                                                <div
                                                                    class="qty-ctl"
                                                                >
                                                                    <button
                                                                        onclick="changeQty(0); return false;"
                                                                        class="decrease"
                                                                    ></button>
                                                                </div>
                                                                <input
                                                                    type="number"
                                                                    name="qty"
                                                                    id="qty"
                                                                    value="1"
                                                                    min="1"
                                                                    class="input-text qty"
                                                                />
                                                                <div
                                                                    class="qty-ctl"
                                                                >
                                                                    <button
                                                                        onclick="changeQty(1); return false;"
                                                                        class="increase"
                                                                    ></button>
                                                                </div>
                                                            </div>

                                                            <div class="">
                                                                <button
                                                                    data-id="{{$product->id}}"
                                                                    type="button"
                                                                    id="product-addtocart-button"
                                                                    class="button btn-cart btn-cart-detail btn-add-to-cart"
                                                                >
                                                                    <span
                                                                        ><span
                                                                            >Thêm
                                                                            vào
                                                                            giỏ
                                                                            hàng</span
                                                                        ></span
                                                                    >
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <!-- /.add-to-cart -->
                                                    </div>
                                                    <!-- /.add-to-box -->
                                                    @endif
                                                </div>
                                                <!-- /.em-product-info-basic -->
                                            </div>
                                        </div>
                                        <!-- /.em-product-view-secondary -->
                                    </div>
                                    <div class="clearer"></div>
                                </div>
                                <!-- /.product-view-detail -->
                            </form>
                        </div>
                        <!-- /.product-essential -->

                        <div class="clearer"></div>
                        <div class="row">
                            <div
                                class="em-product-view-primary col-sm-24 first"
                            >
                                <div class="em-product-info">
                                    <div class="em-product-details">
                                        <div
                                            class="em-details-tabs product-collateral"
                                        >
                                            <div
                                                class="em-details-tabs-content"
                                            >
                                                <div
                                                    class="box-collateral em-line-01 box-description"
                                                >
                                                    <div class="em-block-title">
                                                        <h2>
                                                            Thông tin sản phẩm
                                                        </h2>
                                                    </div>
                                                    <div>
                                                        {!! $product->description
                                                        !!}
                                                    </div>
                                                </div>
                                                <!-- /.box-collateral -->
                                            </div>
                                            <!-- /.em-details-tabs-content -->
                                        </div>
                                        <!-- /.em-details-tabs -->
                                    </div>
                                    <!-- /.em-product-details -->
                                </div>
                                <!-- /.em-product-info -->
                                <div
                                    id="em-product-shop-pos-bottom"
                                    style="display: inline-block"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.product-view -->
                </div>
            </div>
        </div>
        <!-- /.em-main-container -->
    </div>
</div>

<script type="text/javascript">
    $(".btn-add-to-cart").click(function () {
        var id = $(this).attr("data-id");
        var qty = Number($("#qty").val());
        if (qty <= 0) {
            swal({
                title: "Thất bại",
                text: "Số lượng sản phẩm không hợp lệ!",
                icon: "error",
                buttons: true,
                dangerMode: true,
                buttons: ["Ok"],
            });
        } else {
            var qty = parseInt(qty);
            var count = Number($(".em-topcart-qty").html());
            $.ajax({
                type: "post",
                url: "/add/item",
                data: {
                    _token: $('[name="_token"]').val(),
                    id: id,
                    qty: qty,
                },
                success: function (response) {
                    if(response.is === 'success'){
                        count = count + qty;
                        $(".em-topcart-qty").html(count);
                        swal({
                            title: "Đã xong!",
                            text: "Sản phẩm của bạn đã được thêm vào giỏ hàng",
                            icon: "success",
                            buttons: true,
                            dangerMode: true,
                            buttons: ["Tiếp tục mua hàng ", "Gửi đơn hàng ngay!"],
                        })
                        .then(flag =>{
                            if(flag){
                                window.location.href="/checkout/cart";
                            }
                        })
                    }
                    else{
                        swal({
                            title: "Lỗi!",
                            text: response.message,
                            icon: "error",
                            buttons: true,
                            dangerMode: true,
                            buttons: ["Tiếp tục mua hàng", "Hủy"],
                        })
                    }
                }
            });
        }
    });

    $(".btn-add-to-wishlist").click(function () {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "post",
            url: "/wishlist",
            data: {
                _token: $('[name="_token"]').val(),
                id: id,
            },
            success: function (response) {
                if (response.is === "success") {
                    swal({
                        title: "Hoàn thành!",
                        text: "Sản phẩm đã được thêm vào danh sản phẩm yêu thích",
                        icon: "success",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 1500,
                    });
                }
                if (response.is === "unsuccess") {
                    swal({
                        title: "Thất bại!",
                        text: "Sản phẩm đang được cập nhật!",
                        icon: "warning",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 1500,
                    });
                }
                if (response.is === "exist") {
                    swal({
                        text: "Sản phẩm đã tồn tại trong danh sản phẩm yêu thích của bạn!",
                        icon: "info",
                        buttons: true,
                        buttons: ["Ok"],
                        timer: 2000,
                    });
                }
                if (response.is === "notlogged") {
                    swal({
                        title: "Bạn chưa đăng nhập",
                        text: "Bạn cần đăng nhập để thực hiện chức năng này!",
                        icon: "info",
                        buttons: true,
                        dangerMode: true,
                        buttons: ["Đóng", "Đăng nhập"],
                    }).then((flag) => {
                        if (flag) {
                            window.location.href = "/login";
                        }
                    });
                }
            },
        });
    });
</script>
@endif @endsection
