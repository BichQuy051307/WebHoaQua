@extends('layouts.home')

@section('title')
    Sản phẩm yêu thích
@endsection

@section('js')
<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
@endsection

@section('home')

<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-wrapper-area02"></div>
            <div class="em-wrapper-area03"></div>
            <div class="em-wrapper-area04"></div>
            <div class="em-main-container em-col2-left-layout">
                <div class="row">
                    <div class="col-sm-18 col-sm-push-6 em-col-main clearfix">
                        @if(isset($wishlists) && empty($wishlist))
                            <div class="my-wishlist">
                                <div class="page-title title-buttons" style="text-align : center; margin-bottom : 20px;">
                                    <h3 class="section-title section-title-center" style="text-align: center; text-transform: uppercase; color : #555;">
                                    <b></b>
                                    <span class="section-title-main"><i class="fa fa-heart" style="color: red;"></i> Sản phẩm yêu thích <i class="fa fa-heart" style="color: red;"></i></span>
                                    <b></b>
                                    </h3>
                                </div>
                                    <form id="wishlist-view-form">
                                        @csrf
                                        <fieldset>
                                            <table class="data-table">
                                                <tbody>
                                                    @foreach($wishlists as $wishlist)
                                                    <tr>
                                                        <td class="col-sm-3" style="text-align : center;">
                                                            <a class="product-image" href="{{url('/san-pham/'.$wishlist->slug)}}" > 
                                                                <img src="{{asset('images/products/'.$wishlist->image)}}" style="width : 80px; height : 100px;" alt="{{$wishlist->name}}" /> 
                                                            </a>
                                                            @if($wishlist->quantity > 0)
                                                                <div style="background:#6df31a; color:#fff; font-weight:bold; font-size:12px; text-align:center;">
                                                                    Còn hàng
                                                                </div>
                                                            @else
                                                                <div style="background:#ff0000; color:#fff; font-weight:bold; font-size:12px; text-align:center;">
                                                                    Hết hàng
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="col-sm-8" style="text-align : center;">
                                                            <h1 class="product-name">
                                                                <a href="{{url('/san-pham/'.$wishlist->slug)}}"> 
                                                                    {{$wishlist->name}}
                                                                </a>
                                                            </h1>
                                                        </td>
                                                        <td class="col-sm-8" style="text-align : center;">
                                                            <div class="cart-cell">
                                                                <div class="price-box"> 
                                                                    @if($wishlist->price <=  $wishlist->price_sale)
                                                                    <span class="regular-price" id="product-price-258"> 
                                                                        <span class="price" style="color : #03A9F4;">
                                                                        {{number_format($wishlist->price_sale*1000 ,0 ,'.' ,'.')}} VND
                                                                        </span>
                                                                    </span>
                                                                    @else
                                                                    <p class="old-price">
                                                                        <span class="price" id="old-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a">
                                                                        {{number_format($wishlist->price*1000 ,0 ,'.' ,'.')}} VND
                                                                        </span>
                                                                    </p>
                                                                    <br>

                                                                    <p class="special-price">
                                                                        <span class="price" content="60" id="product-price-182-emprice-e28d8be0787e9d8ae65c6afe74f8df0a" style="color: #03A9F4;">
                                                                        {{number_format($wishlist->price_sale*1000 ,0 ,'.' ,'.')}} VND
                                                                        </span>
                                                                    </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="col-sm-3" style="text-align : center;">
                                                            @if($wishlist->quantity > 0)
                                                            <div class="add-to-cart-alt">
                                                            <button title="Thêm vào giỏ hàng" data-id="{{$wishlist->product_id}}" type="button" class="button btn-cart btn-add-to-cart">
                                                            </button>
                                                            @endif
                                                        </div>
                                                        </td>
                                                        <td class="col-sm-2" style="text-align : center;">
                                                            <button type="button" data-id="{{$wishlist->id}}" title="Xóa" class="btn-remove btn-remove-wishlist"></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        
                                        </fieldset>
                                    </form>
                               
                            </div>
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
                            <div style="text-align: center;">
                                {!! urldecode($wishlists->appends(request()->query())->links('vendor.pagination.default')); !!}
                            </div>
                        @endif
                        <div class="buttons-set right" style="margin-top : 20px; margin-bottom : 20px;">
                            <p class="back-link"><a href="{{ url('/') }}"><small>&laquo; </small>Quay lại cửa hàng</a>
                            </p>
                        </div>
                    </div><!-- /.em-col-main -->

                    <div class="col-sm-6 col-sm-pull-18 em-col-left em-sidebar">
                        <div id="menuleftText" class="all_categories">
                            <div class="menuleftText-title">
                                <div class="menuleftPerson"><span class="em-text-upercase">Quản lý tài khoản</span>
                                </div>
                            </div>
                            </div><!-- /.menuleftText -->

                            <div class="menuleft">
                                <div id="menu-default" class="mega-menu em-menu-icon">
                                    <div class="megamenu-wrapper wrapper-5_4607">
                                        <div class="em_nav" id="toogle_menu_5_4607">
                                            <ul class="vnav em-menu-icon effect-menu em-menu-long">
                                                <li class="menu-item-link menu-item-depth-0 fa fa-child">
                                                    <a class="em-menu-link" href="{{ url('/my/account/'.Auth::user()->id) }}"> <span>  Thông tin tài khoản </span> </a>
                                                </li><!-- /.menu-item-link -->

                                                <li class="menu-item-link menu-item-depth-0 fa fa-shopping-cart">
                                                    <a class="em-menu-link" href="{{ url('/order/history/'.Auth::user()->id) }}"> <span> Đơn hàng của tôi </span> </a>
                                                </li><!-- /.menu-item-link -->

                                                <li class="menu-item-link menu-item-depth-0 fa fa-heart">
                                                    <a class="em-menu-link" href="{{ url('/wishlist') }}"> 
                                                    <span style="color : #ffffff; border-color: #fdbd8d; background-color: #ff0099;"> Sản phẩm yêu thích </span> </a>
                                                </li><!-- /.menu-item-link -->

                                                <li class="menu-item-link menu-item-depth-0 fa fa-recycle">
                                                    <a class="em-menu-link" href="{{ url('/change/password') }}"> 
                                                        <span> Đổi mật khẩu </span> 
                                                    </a>
                                                </li><!-- /.menu-item-link -->
                                            </ul><!-- /.vnav -->
                                        </div>
                                    </div><!-- /.megamenu-wrapper -->
                                </div>
                            </div><!-- /.menuleft -->                            
                        </div><!-- /.block-layered-nav -->

                    </div><!-- /.em-sidebar -->
                </div>
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div><!-- /.em-wrapper-main -->

<script type="text/javascript">
    $('.btn-remove-wishlist').click(function(){
        var id = $(this).attr('data-id');
        swal({
            text: "Bạn chắc chắn?",
            icon: "error",
            buttons: true,
            dangerMode: true,
        })
        .then(willDelete =>{
            if(willDelete){
                $.ajax({
                    type : 'delete',
                    url : '/remove-wishlist/' + id,
                    data:{
                        _token : $('[name="_token"]').val(),
                    },
                    success: function(response){
                        window.location.reload();
                    },
                    error: function(response){
                        window.location.href="/wishlist";
                    }
                })
            }
        })
    });

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
</script>              
@endsection



