@extends('layouts.home')

@section('title')
    Đơn hàng của tôi 
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
                        @if(isset($orders))
                            <div>
                                <form id="wishlist-view-form">
                                    @csrf
                                    <fieldset>
                                        <table class="data-table" style="font-size : 13.5px;">
                                            <thead>
                                                <tr>
                                                    <td class="col-sm-3" style="text-align : center;">
                                                        Mã đơn hàng
                                                    </td>
                                                    <td class="col-sm-2" style="text-align : center;">
                                                        Ngày đặt mua
                                                    </td>
                                                    
                                                    <td class="col-sm-3" style="text-align : center;">
                                                        Tổng tiền
                                                    </td>
                                                    
                                                    <td class="col-sm-5" style="text-align : center;">
                                                        Thanh toán tiền mặt
                                                    </td>
                                                    <td class="col-sm-4" style="text-align : center;">
                                                        Trạng thái
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td class="col-sm-3" style="text-align : center;">
                                                        <a href="{{ url('/order/detail/'.$order->order_id) }}" > 
                                                            {{$order->order_id}}
                                                        </a>
                                                    </td>
                                                    <td class="col-sm-2" style="text-align : center;">
                                                        {{$order->created_at}}
                                                    </td>
                                                    
                                                    <td class="col-sm-3" style="text-align : center;">
                                                        {{number_format($order->amount*1000 ,0 ,'.' ,'.')}} VND
                                                    </td>
                                                    
                                                    <td class="col-sm-5" style="text-align : center; color : #03A9F4;">
                                                        {{number_format($order->amount*1000 ,0 ,'.' ,'.')}} VND
                                                    </td>
                                                    <td class="col-sm-4" style="text-align : center;">
                                                        @if($order->status == 0)
                                                                <span style="background-color: #ffc800 !important; color : #fff; padding: 4px 5px; font-size : 8px; font-weight: bold;">Đang chờ</span>
                                                            @else
                                                            @if($order->status == 1)
                                                                <span style="background-color: #00c0ef !important; color : #fff; padding: 4px 5px; font-size : 8px; font-weight: bold;">Đang giao hàng</span>
                                                                @else
                                                                @if($order->status == 2)
                                                                <span style="background-color: #00a65a !important; color : #fff; padding: 4px 5px; font-size : 8px; font-weight: bold;">Đã giao hàng</span>
                                                                @else
                                                                @if($order->status == 3)
                                                                <span style="background-color: #dd4b39 !important; color : #fff; padding: 4px 5px; font-size : 8px; font-weight: bold;">Đã hủy</span>
                                                                @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    
                                    </fieldset>
                                </form>
                            </div>
                            <div style="text-align: center;">
                                {!! urldecode($orders->appends(request()->query())->links('vendor.pagination.default')); !!}
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
                                                    <a class="em-menu-link" href="{{ url('/order/history/'.Auth::user()->id) }}"> 
                                                    <span style="color : #ffffff; border-color: #fdbd8d; background-color: #ff0099;"> Đơn hàng của tôi </span> </a>
                                                </li><!-- /.menu-item-link -->

                                                <li class="menu-item-link menu-item-depth-0 fa fa-heart">
                                                    <a class="em-menu-link" href="{{ url('/wishlist') }}"> <span> Sản phẩm yêu thích </span> </a>
                                                </li><!-- /.menu-item-link -->

                                                <li class="menu-item-link menu-item-depth-0 fa fa-recycle">
                                                    <a class="em-menu-link" href="{{ url('/change/password') }}"> <span> Đổi mật khẩu </span> </a>
                                                </li><!-- /.menu-item-link -->
                                            </ul><!-- /.vnav -->
                                        </div>
                                    </div><!-- /.megamenu-wrapper -->
                                </div>
                            </div><!-- /.menuleft -->

                            <div class="em-wrapper-area02"></div>
                            @if(isset($promotion))
                            <div class="em-wrapper-banners hidden-xs">
                                <div class="em-effect06">
                                    <a class="em-eff06-04" href="javascript:void(0)">
                                    <img class="img-responsive retina-img" src="{{asset('/images/promotions/'.$promotion->image)}}" />
                                    </a>
                                </div>
                            </div><!--  /.em-wrapper-banners -->
                            @endif
                            
                        </div><!-- /.block-layered-nav -->

                    </div><!-- /.em-sidebar -->
                </div>
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div><!-- /.em-wrapper-main -->
@endsection


