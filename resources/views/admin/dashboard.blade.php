@extends('layouts.admin') @section('content')
<div class="row">
    <div class="item">
        <a href=""> 
            <img alt="" class="lazyOwl img-responsive" src="https://hoaquafuji.com/themes/hoaquafuji/assets/img/banner-mobile.jpg" /> 
        </a>
    </div>
</div>
@endsection('content') @section('js')
<script src="{{
        asset('assets/template/vendors/chart.js/Chart.min.js')
    }}"></script>
<!-- End custom js for this page-->
@endsection('js')
