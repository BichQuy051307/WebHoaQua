@extends('layouts.admin') @section('content')
<section class="content">
    <div class="row">
        @csrf
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Đơn hàng đã hủy</p>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">
                            <thead>
                                <tr>
                                    <th class="col-sm-2 text-center">
                                        Mã đơn hàng
                                    </th>
                                    <th class="col-sm-2 text-center">
                                        Khách hàng
                                    </th>
                                    <th class="col-sm-2 text-center">
                                        <span>Số điện thoại</span>
                                        <span>Email</span>
                                    </th>
                                    <th class="col-sm-2 text-center">
                                        Thời gian đặt hàng
                                    </th>
                                    <th class="col-sm-2 text-center">
                                        Tổng thanh toán
                                    </th>
                                    <th class="col-sm-2 text-center">
                                        Trạng thái
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($orders)) @foreach ($orders as $value)
                                <tr>
                                    <td class="col-sm-2 text-center">
                                        <a
                                            href="/admin/order/{{$value->order_id}}"
                                            >{{$value->order_id}}</a
                                        >
                                    </td>
                                    <td class="col-sm-2 text-center">
                                        {{$value->name}}
                                    </td>
                                    <td class="col-sm-2 text-center">
                                        <p>{{$value->phone}}</p>
                                        <p>{{$value->email}}</p>
                                    </td>
                                    <td class="col-sm-2 text-center">
                                        {{$value->created_at}}
                                    </td>

                                    <td class="col-sm-2 text-center">
                                        {{number_format(($value->amount+$value->score_awards)*1000 ,0 ,'.' ,'.')}}
                                        VND
                                    </td>
                                    <td class="col-sm-2 text-center">
                                        @if($value->status == 3)
                                        <button
                                            data-id="{{$value->id}}"
                                            type="button"
                                            class="btn btn-update btn-danger"
                                            style="
                                                color: #fff;
                                                padding: 8px 20px;
                                                border-radius: 5px;
                                                text-transform: uppercase;
                                            "
                                        >
                                            Đã hủy
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection