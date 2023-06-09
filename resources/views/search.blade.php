@extends('layouts.home')

@section('title')
    Kết quả tìm kiếm
@endsection

@section('js')
<script type="text/javascript" src="{{asset('home/js/jquery-ui.min.js')}}"></script>

<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>

<script type="text/javascript">
    (function($) {
        //Ready Function
        $(document).ready(function() {
            setColumnCountGridMode();
        });
        
        if (typeof EM == 'undefined') EM = {};
        if (typeof EM.SETTING == 'undefined') EM.SETTING = {};

        function setColumnCountGridMode() {
            var wWin = $(window).width();
            if (EM.SETTING.DISABLE_RESPONSIVE == 1) {
                var sDesktop = 'emcatalog-desktop-';
                var sDesktopSmall = 'emcatalog-desktop-small-';
                var sTablet = 'emcatalog-tablet-';
                var sMobile = 'emcatalog-mobile-';
                var sGrid = $('#em-grid-mode');
                if (wWin > 1200) {
                    sGrid.removeClass().addClass(sDesktop + '5');
                } else {
                    if (wWin <= 1200 && wWin > 768) {
                        sGrid.removeClass().addClass(sDesktopSmall + '4');
                    } else {
                        if (wWin <= 768 && wWin > 480) {
                            sGrid.removeClass().addClass(sTablet + '4');
                        } else {
                            sGrid.removeClass().addClass(sMobile + '2');
                        }
                    }
                }
            } else {
                var sDesktop = 'emcatalog-desktop-';
                var sGrid = $('#em-grid-mode');
                sGrid.removeClass().addClass(sDesktop + '4');
            }
        };

        $(window).resize($.throttle(300, function() {
            setColumnCountGridMode();
        }));
    })(jQuery);
</script>
@endsection

@section('home')
<div class="row" style="margin-top : 10px; padding-left : 20px;">
    <p style="font-size : 18px; font-weight : 500;">
        Kết quả tìm kiếm cho
            <span style="font-weight : 600;">
                @if(isset($parameter))
                    "{{$parameter}}"
                @endif
            </span>
    </p>
</div>

@if(isset($products) && $products->isNotEmpty())
<div class="row">
    <div class="category-products">
        <div id="em-grid-mode">
            <ul class="emcatalog-grid-mode products-grid emcatalog-disable-hover-below-mobile">
                
                    @foreach($products as $item)
                        <div class="item" style="">
                            @if($item->price_sale < $item->price)
                                <div class="product-item" style="height : 380px; margin-top : 30px; box-sizing : border-box;">
                                    <div class="product-shop-top">
                                        <a href="{{ url('/san-pham/'.$item->slug) }}" title="" class="product-image">
                                            <!--show label product - label extension is required-->
                                            <ul class="productlabels_icons">
                                                @if(floor(($item->price - $item->price_sale)/($item->price)*100) >= 15)
                                                    <li class="label hot">
                                                        <p>
                                                            Hot 
                                                        </p>
                                                    </li>
                                                @else
                                                    <li class="label sale">
                                                        <p>
                                                            Sale 
                                                        </p>
                                                    </li>
                                                @endif
                                                <li class="label special">
                                                    <p>
                                                        <span>{{floor(($item->price - $item->price_sale)/($item->price)*100)}}%</span> </p>
                                                </li>
                                            </ul>

                                            <img class="em-alt-hover img-responsive em-lazy-loaded" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->name}}" style="width: 100%;">

                                            <img class="img-responsive em-alt-org em-lazy-loaded" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->name}}" style="width: 100%;">
                                        </a>
                                        <div class="em-element-display-hover bottom">
                                            <div class="quickshop-link-container">
                                                <a href="{{ url('/san-pham/'.$item->slug) }}" class="quickshop-link" title="Xem sản phẩm">Xem sản phẩm</a>
                                            </div>

                                            <div class="em-btn-addto">
                                                <!--product add to cart-->
                                                @csrf
                                                @if($item->quantity > 0)
                                                <button data-id="{{$item->id}}" type="button" title="Thêm vào giỏ hàng" class="button btn-cart btn-add-to-cart" >
                                                </button>
                                                @endif

                                                <!--product add to compare-wishlist-->
                                                <ul class="add-to-links">
                                                    <li>
                                                        <button data-id="{{$item->id}}" type="button" class="link-wishlist btn-add-to-wishlist" title="Yêu thích">
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- /.product-shop-top -->
                                    

                                    <div class="product-shop">
                                        <div class="f-fix">
                                            <!--product name-->
                                            <h3 style="min-height: 19px; text-transform: capitalize;" class="product-name"><a href="/san-pham/{{$item->slug}}" title=""> {{$item->name}} </a></h3>

                                            <div class="price-box">
                                                <p class="old-price">
                                                    <span class="price" id="old-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a">
                                                    {{number_format($item->price*1000 ,0 ,'.' ,'.')}} VND
                                                    </span>
                                                </p>
                                                <br>

                                                <p class="special-price">
                                                    <span class="price" content="60" id="product-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a" style="color: #0000FF;">
                                                    {{number_format($item->price_sale*1000 ,0 ,'.' ,'.')}} VND
                                                    </span>
                                                </p>

                                            </div>

                                        </div>
                                    </div><!-- /.product-shop -->
                                </div>
                            @else
                            <div class="product-item" style="height : 380px; margin-top : 30px; box-sizing : border-box;">
                                    <div class="product-shop-top">
                                        <a href="/san-pham/{{$item->slug}}" title="" class="product-image">
                                            <!--show label product - label extension is required-->
                                            <img style="" class="em-alt-hover img-responsive em-lazy-loaded" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->name}}" style="width: 100%;">

                                            <img class="img-responsive em-alt-org em-lazy-loaded" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->name}}" style="width: 100%;">
                                        </a>
                                        <div class="em-element-display-hover bottom">
                                            <div class="quickshop-link-container">
                                                <a href="{{ url('/san-pham/'.$item->slug) }}" class="quickshop-link" title="Xem sản phẩm">Xem sản phẩm</a>
                                            </div>

                                            <div class="em-btn-addto">
                                                <!--product add to cart-->
                                                @csrf
                                                @if($item->quantity > 0)
                                                <button data-id="{{$item->id}}" type="button" title="Thêm vào giỏ hàng" class="button btn-cart btn-add-to-cart" >
                                                </button>
                                                @endif

                                                <!--product add to compare-wishlist-->
                                                <ul class="add-to-links">
                                                    <li>
                                                        <button data-id="{{$item->id}}" type="button" class="link-wishlist btn-add-to-wishlist" title="Yêu thích">
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- /.product-shop-top -->
                                    

                                    <div class="product-shop">
                                        <div class="f-fix">
                                            <!--product name-->
                                            <h3 style="min-height: 19px; text-transform: capitalize;" class="product-name"><a href="/san-pham/{{$item->slug}}" title=""> {{$item->name}} </a></h3>

                                            <div class="price-box">
                                                <br>
                                                <p class="special-price">
                                                    <span class="price" content="60" id="product-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a" style="color: #0000FF;">
                                                    {{number_format($item->price_sale*1000 ,0 ,'.' ,'.')}} VND
                                                    </span>
                                                </p>
                                            </div>

                                        </div>
                                    </div><!-- /.product-shop -->
                                </div>
                            @endif
                        </div><!-- item -->
                    @endforeach

            </ul>
        </div><!-- /.em-grid-mode -->
    </div><!-- /.category-products -->

    <script type="text/javascript">
        $('.btn-add-to-cart').click(function(){
            var id = $(this).attr('data-id');
            var count = Number($(".em-topcart-qty").html());
            $.ajax({
                type : 'post',
                url : '/checkout/cart',
                data : {
                    _token :$('[name="_token"]').val(),
                    id : id,
                },
                success : function(response){
                    count++;
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
            });
        });

        $('.btn-add-to-wishlist').click(function(){
            var id = $(this).attr('data-id');
            $.ajax({
                type : 'post',
                url : '/wishlist',
                data : {
                    _token :$('[name="_token"]').val(),
                    id : id,
                },
                success : function(response){
                    if(response.is === 'success'){
                        swal({
                            title: "Hoàn thành!",
                            text: "Sản phẩm đã được thêm vào danh sách yêu thích",
                            icon: "success",
                            buttons: true,
                            buttons: ["Ok"],
                            timer: 1500
                        });
                    }
                    if(response.is === 'unsuccess'){
                        swal({
                            title: "Thất bại!",
                            text: "Sản phẩm đang được cập nhật!",
                            icon: "warning",
                            buttons: true,
                            buttons: ["Ok"],
                            timer: 1500
                        });
                    }
                    if(response.is === 'exist'){
                        swal({
                            text: "Sản phẩm đã tồn tại trong danh sách yêu thích của bạn!",
                            icon: "info",
                            buttons: true,
                            buttons: ["Ok"],
                            timer: 2000
                        });
                    }
                    if(response.is === 'notlogged'){
                        swal({
                            title: "Bạn chưa đăng nhập",
                            text: "Bạn cần đăng nhập để thực hiện chức năng này!",
                            icon: "info",
                            buttons: true,
                            dangerMode: true,
                            buttons: ["Đóng","Đăng nhập"],
                            
                        })
                        .then(flag => {
                            if(flag){
                                window.location.href="/login";
                            }
                        })
                    }
                },
            });
        })
    </script>
</div>
@else
    <div style="margin-bottom : 100px;">
        <p style="text-align : center; font-size : 18px; font-weight : 600;">
            <i class="fa fa-exclamation-triangle" style="color : #ff0000;"></i> 
            Rất tiếc! Không có sản phẩm nào được tìm thấy!
        </p>
    </div>

    <div class="row hidden-xs" style="margin-top : 30px;">
        <h3 class="section-title section-title-center" style="text-align: center; text-transform: uppercase; color : #555;">
        <b></b>
        <span class="section-title-main">Sản phẩm mới nhất</span>
        <b></b>

        <style>
            .section-title {
                position: relative;
                display: flex;
                flex-flow: row wrap;
                align-items: center;
                justify-content: space-between;
                width: 100%;
            }
            .section-title b {
                display: block;
                -ms-flex: 1;
                flex: 1;
                height: 2px;
                opacity: .1;
                background-color: currentColor;
            }
        </style>
        </h3>
        <div class="em-wrapper-banners">
            <div class=" slider-style02">
                <div class="em-slider em-slider-banners em-slider-navigation-icon" 
                    data-emslider-navigation="true" data-emslider-items="6" 
                    data-emslider-desktop="5" data-emslider-desktop-small="4" 
                    data-emslider-tablet="3" data-emslider-mobile="2">

                        @if(isset($list_products))
                            @foreach($list_products as $item)
                            <div class="item" style="margin-top : 30px;">
                                <a href="{{ url('/san-pham/'.$item->slug) }}">
                                    <img class="img-responsive em-alt-org em-lazy-loaded" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->name}}" height="110" width="110">
                                </a>
                                <div class="product-shop">
                                    <div class="f-fix">
                                        <!--product name-->
                                        <h3 class="product-name" style="margin-top : 10px; text-transform: capitalize;"><a href="{{ url('/san-pham/'.$item->slug) }}" title="">{{$item->name}}</a></h3>
                                        <!--product price-->
                                        <div class="price-box">
                                            @if($item->price_sale < $item->price)
                                            <p class="old-price">
                                                <span class="price">
                                                {{number_format($item->price*1000 ,0 ,'.' ,'.')}} VND
                                                </span>
                                            </p>
                                            @endif

                                            <p class="special-price">
                                                <span class="price" content="60" style="color: #0000FF;">
                                                {{number_format($item->price_sale*1000 ,0 ,'.' ,'.')}} VND
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.item -->
                            @endforeach
                        @endif
                </div>
            </div><!-- /.slider-style02 --> 
        </div>
    </div>
@endif
@endsection
