@extends('layouts.home')

@section('title')
    Giới thiệu 
@endsection

@section('js')
<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
@endsection

@section('home')

<div class="em-wrapper-main">
    <div class="container container-main">
        <div class="em-inner-main">
            <div class="em-wrapper-area02"></div>
            <div class="em-main-container em-col2-left-layout">
                <div class="row"> 
                    <div class="col-sm-24 em-col-main">
                        <div class="em_post-item">                           
                            <div class="" style="text-align : justify; padding: 10px 10px; line-height : 30px;">
                                <img src="https://hoaquafuji.com/storage/app/media/gioi-thieu/gioi-thieu-1.jpg" alt="" style="width: 100%;">
                            </div>
                        </div>
                    </div><!-- /.em-col-main -->
                </div>
            </div><!-- /.em-main-container -->
        </div>
    </div>
</div>            
@endsection



