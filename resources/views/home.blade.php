@extends('layouts.home')

@section('title')
Cửa hàng trái cây
@endsection

@section('js')
<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
@endsection

@section('introduction')
<div class="row em-wrapper-ads-13 hidden-xs">
    <div class="text-box col-sm-8">
        <a class="icon-banner-left pull-left"href="javascript:void(0)">
            <em class="fa fa-fw"><i class="fa fa-hospital-o"></i></em>
        </a>
        <div class="em-banner-right">
            <h5><a href="javascript:void(0)">HOA QUẢ TƯƠI SẠCH</a></h5>
            <p style="font-size : 13px;">Quy trình nhập hàng, vận chuyển, bảo quản chuyên nghiệp.</p>
        </div>
    </div>
    <div class="text-box col-sm-8">
        <a class="icon-banner-left pull-left" href="javascript:void(0)">
            <em class="fa fa-fw"><i class="fa fa-user-md"></i></em>
        </a>
        <div class="em-banner-right">
            <h5><a title="Free shipping all order" href="javascript:void(0)">ĐỔI TRẢ MIỄN PHÍ</a></h5>
            <p style="font-size : 13px;">Đổi trả miễn phí trong 24h khi khách hàng không hài lòng</p>
        </div>
    </div>
    <div class="text-box col-sm-8">
        <a class="icon-banner-left pull-left" href="javascript:void(0)">
            <em class="fa fa-fw"><i class="fa fa-tags"></i></em>
        </a>
        <div class="em-banner-right">
            <h5><a href="javascript:void(0)">Giá cả cạnh tranh</a></h5>
            <p style="font-size : 13px;">Fuji Fruit luôn đặt lợi ích cho người tiêu dùng lên hàng đầu.</p>
        </div>
    </div>
</div><!-- /.em-wrapper-ads-13-->
@endsection

@section('home')
<div class="row">    
    <div class="col-sm-24 em-col-main">
        <div class="em-wrapper-area03">
            <div class="em-slideshow">
                <div class="em-owlcarousel-slideshow">
                    <div id="em_owlcarousel_2_2484_sync1" class="owl-carousel">
                        <div class="item">
                            <a href=""> 
                                <img alt="" class="lazyOwl img-responsive" src="https://hoaquafuji.com/storage/app/uploads/public/728/998/fd3/thumb__1920_0_0_0_auto.jpg" /> 
                            </a>
                        </div>
                        <div class="item">
                            <a href=""> 
                                <img alt="" class="lazyOwl img-responsive" src="https://hoaquafuji.com/storage/app/uploads/public/19a/c71/6d8/thumb__1920_0_0_0_auto.jpg" /> 
                            </a>
                        </div>
                        <div class="item">
                            <a href=""> 
                                <img alt="" class="lazyOwl img-responsive" src="https://hoaquafuji.com/storage/app/uploads/public/c94/4a7/679/thumb__1920_0_0_0_auto.jpg" /> 
                            </a>
                        </div>
                        <div class="item">
                            <a href=""> 
                                <img alt="" class="lazyOwl img-responsive" src="https://hoaquafuji.com/storage/app/uploads/public/fb9/03f/f84/thumb__1920_0_0_0_auto.jpg" /> 
                            </a>
                        </div>
                        <div class="item">
                            <a href=""> 
                                <img alt="" class="lazyOwl img-responsive" src="https://hoaquafuji.com/storage/app/uploads/public/d6d/476/56f/thumb__1920_0_0_0_auto.jpg" /> 
                            </a>
                        </div>

                    </div><!-- /# em_owlcarousel_2_2484_sync1 -->
                </div><!-- /.em-owlcarousel-slideshow -->
            </div><!-- /.em-slideshow -->
        </div><!-- /.em-wrapper-area03 -->
        <div class="std"></div>
    </div><!-- /.em-col-main -->
</div>

<div class="row">
    <div class="col-sm-24">
        <div class="em-wrapper-new-arrivals-tabs">
            <div class="em-new-arrivals-tabs em-line-01">
                <div class="emtabs-ajaxblock-loaded">
                    <div class="em-tabs-widget tabs-widget ">
                        <div class="widget-title em-widget-title" style="margin-top : 50px; margin-bottom : 50px; text-align: center;">
                            <h3 class="hidden-xs" style="color : #555;"><span>Sản phẩm nổi bật</span></h3>
                        </div>
                        <div id="emtabs_1" class="em-tabs emtabs r-tabs">
                            <div class="em-tabs-content tab-content">
                                <div id="tab_emtabs_1_1" class="tab-pane tab-item content_tab_emtabs_1_1 r-tabs-panel r-tabs-state-active">
                                    <div class="wrapper button-show01 button-hide-text em-wrapper-loaded">
                                        <div class="emfilter-ajaxblock-loaded">
                                            <div id="em_fashion_new_arrivals_tab01" class="em-grid-20 ">

                                                <div class="widget em-filterproducts-grid">
                                                    <div class="widget-products em-widget-products">
                                                        <div class="emcatalog-desktop-5">
                                                            <div class="products-grid">

                                                                @if(isset($list_products))
                                                                    @foreach($list_products as $item)
                                                                        <div class="item last" style="  ">

                                                                            @if($item->price_sale < $item->price)
                                                                                <div class="product-item" style="height : 400px; margin-top : 30px; box-sizing : border-box;">
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

                                                                                            <img class="em-alt-hover img-responsive em-lazy-loaded" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->name}}" style="width: 100%; height: 220px;">

                                                                                            <img class="img-responsive em-alt-org em-lazy-loaded" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->name}}" style="width: 100%; height: 220px;">
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
                                                                                            <h3 style="min-height: 58px; height:58px;" class="product-name"><a href="/san-pham/{{$item->slug}}" style="text-transform: capitalize;"> {{$item->name}} </a></h3>

                                                                                            <div class="price-box">
                                                                                                @if($item->quantity > 0)
                                                                                                    
                                                                                                @else
                                                                                                    <div style="background:#ff0000; height:30px; padding-top:6px; color:#fff; font-weight:bold; font-size:12px; text-align:center; text-transform:uppercase;">
                                                                                                        hết hàng
                                                                                                    </div>
                                                                                                @endif
                                                                                                <p class="old-price">
                                                                                                    <span class="price" id="old-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a">
                                                                                                    {{number_format($item->price*1000 ,0 ,'.' ,'.')}} VND
                                                                                                    </span>
                                                                                                </p>
                                                                                                <br>

                                                                                                <p class="special-price">
                                                                                                    <span class="price" content="60" id="product-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a" style="color: #00ab9f;">
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
                                                                                        <a href="{{ url('/san-pham/'.$item->slug) }}" class="product-image">
                                                                                            <!--show label product - label extension is required-->
                                                                                            <img class="em-alt-hover img-responsive em-lazy-loaded" src="{{asset('images/'.$item->image)}}" alt="{{$item->name}}" style="width: 100%;">

                                                                                            <img class="img-responsive em-alt-org em-lazy-loaded" src="{{asset('images/'.$item->image)}}" alt="{{$item->name}}" style="width: 100%;">
                                                                                        </a>
                                                                                        <div class="em-element-display-hover bottom">
                                                                                            <div class="quickshop-link-container">
                                                                                            <a href="{{ url('/san-pham/'.$item->slug) }}" class="quickshop-link" title="Xem sản phẩm">Xem sản phẩm</a>
                                                                                            </div>
                                                                                            <div class="em-btn-addto">
                                                                                                <!--product add to cart-->
                                                                                                @csrf
                                                                                                @if($item->quantity > 0)
                                                                                                <button data-id="{{$item->id}}" type="button" title="Thêm vào giỏ hàng" class="button btn-cart btn-add-to-cart">
                                                                                                </button>
                                                                                                @endif
                                                                                                <!--product add to compare-wishlist-->
                                                                                                <ul class="add-to-links">
                                                                                                    <li>
                                                                                                        <button data-id="{{$item->id}}" type="button" title="Yêu thích" class="link-wishlist btn-add-to-wishlist">
                                                                                                        </button>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div><!-- /.product-shop-top -->
                                                                                    
                                                                                    <div class="product-shop">
                                                                                        <div class="f-fix">
                                                                                            <!--product name-->
                                                                                            <h3 style="min-height: 58px; height:58px;" class="product-name"><a href="{{ url('/san-pham/'.$item->slug) }}" style="text-transform: capitalize;"> {{$item->name}} </a></h3>
                                                                                            
                                                                                            <!--product price-->
                                                                                            <div class="price-box">
                                                                                                @if($item->quantity > 0)
                                                                                                    <!-- <div style="background:#6df31a; height:30px; padding-top:6px; color:#fff; font-weight:bold; font-size:12px; text-align:center; text-transform:uppercase;">
                                                                                                        còn hàng
                                                                                                    </div> -->
                                                                                                @else
                                                                                                    <div style="background:#ff0000; height:30px; padding-top:6px; color:#fff; font-weight:bold; font-size:12px; text-align:center; text-transform:uppercase;">
                                                                                                        hết hàng
                                                                                                    </div>
                                                                                                @endif
                                                                                                <p class="special-price">
                                                                                                    <span class="price" content="60" id="product-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a" style="color: #00ab9f; padding-top:20px;">
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
                                                                @endif
                                                                
                                                            </div><!-- /.products-grid -->
                                                        </div><!-- /.emcatalog-desktop-4 -->
                                                    </div><!-- /.widget-products -->
                                                </div><!-- /.widget -->

                                            </div><!-- /#em_fashion_new_arrivals_tab01 -->
                                        </div>
                                    </div>
                                </div><!-- /#tab_emtabs_1_1 -->
                            </div><!-- /.tab-content -->
                        </div><!-- /#emtabs_1 -->
                    </div>
                </div>
            </div><!-- /.em-new-arrivals-tabs -->
        </div><!-- /.em-wrapper-new-arrivals-tabs -->
    </div><!-- /.em-col-main -->
    
</div>

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
                if(response.is === 'success'){
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
                        text: "Sản phẩm đã được thêm vào Danh sách yêu thích",
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
                        text: "Sản phẩm đã tồn tại trong Danh sách yêu thích của bạn!",
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
@endsection

@section('feature')
<div class="col-sm-24  text-center">
    <h3 class="section-title section-title-center" style="text-align: center; text-transform: uppercase; color : #555;">
    <span class="section-title-main">Chúng tôi có gì?</span>
</div>
<div class="em-wrapper-ads-09">
    <div class="row">
        <div class="col-sm-6 text-center em-wrapper-ads-item">
            <div class="em-ads-item">
                <p><em class="fa fa-fw"></em>
                </p>
                <div class="em-ads-content">
                    <h4 class="primary em-text-upercase">Số lượng đầu sản phẩm</h4>
                    <p> Fuji Fruit tự hào khi sở hữu Số lượng đầu sản phẩm hàng đầu tại Việt Nam</p>
                </div>
            </div>
        </div><!-- /.em-wrapper-ads-item -->
        <div class="col-sm-6 text-center em-wrapper-ads-item  line-left line-right">
            <div class="em-ads-item">
                <p><em class="fa fa-fw"></em>
                </p>
                <div class="em-ads-content">
                    <h4 class="primary em-text-upercase">Cửa hàng trực tuyến</h4>
                    <p>Dễ dàng đặt hàng online nhanh chóng trên Fuji Fruit thông qua mọi thiết bị</p>
                </div>
            </div>
        </div><!-- /.em-wrapper-ads-item -->
        <div class="col-sm-6 text-center  em-wrapper-ads-item  line-left line-right">
            <div class="em-ads-item">
                <p><em class="fa fa-fw"></em>
                </p>
                <div class="em-ads-content">
                    <h4 class="primary em-text-upercase">Giao hàng cực nhanh</h4>
                    <p>Miễn phí giao hàng cho những đơn hàng đạt đủ điều kiện</p>
                </div>
            </div>
        </div><!-- /.em-wrapper-ads-item -->
        <div class="col-sm-6 text-center  em-wrapper-ads-item">
            <div class="em-ads-item">
                <p><em class="fa fa-fw"></em>
                </p>
                <div class="em-ads-content">
                    <h4 class="primary em-text-upercase">Hỗ trợ 24/7</h4>
                    <p>Dịch vụ tư vấn chuyên nghiệp luôn sẵn sàng giải đáp mọi thắc mắc của bạn</p>
                </div>
            </div>
        </div><!-- /.em-wrapper-ads-item -->
    </div>
</div>
@endsection

