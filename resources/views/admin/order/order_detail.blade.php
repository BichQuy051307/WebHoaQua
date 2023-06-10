@extends('layouts.admin') @section('content')
    <section class="content" style="font-size: 14px;">
        @if (isset($order) && isset($orders_detail))
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h4>Thông tin đơn hàng</h4>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4 class="page-header">
                                        <i class="fa fa-globe"></i>
                                        <small class="pull-right">
                                            Date :
                                            @if (isset($order))
                                                {{ $order->created_at }}<br>
                                            @endif
                                        </small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <p style="font-weight: 600;">FROM:</p>
                                    <p>Ban quản lý</p>
                                    <p>Email: {{ auth()->user()->email ?? "fujifruit@gmail.com" }}</p>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <p style="font-weight: 600;">TO:</p>
                                    @if (isset($order))
                                        <p>{{ $order->name }}</p>
                                        <p>Địa chỉ: {{ $order->address }}</p>
                                        <p>Điện thoại: {{ $order->phone }}</p>
                                        <p>Email: {{ $order->email }}</p>
                                    @endif
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <br>
                                    <b>Mã đơn hàng: #</b>
                                    @if (isset($order))
                                        {{ $order->order_id }}
                                    @endif
                                    <br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row mt-4">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th class="text-center">Mã sản phẩm</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-center">Giá gốc (VNĐ)</th>
                                                <th class="text-center">Giá bán (VNĐ)</th>
                                                <th class="text-center">Giảm (%)</th>
                                                <th class="text-center">Tạm tính (VNĐ)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($orders_detail))
                                                @foreach ($orders_detail as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td class="text-center">{{ $item->code }}</td>
                                                        <td class="text-center">{{ $item->quantity }}</td>
                                                        <td class="text-center">
                                                            {{ number_format($item->price * 1000, 0, '.', '.') }}</td>
                                                        <td class="text-center">
                                                            {{ number_format($item->price_sale * 1000, 0, '.', '.') }}</td>
                                                        <td class="text-center">
                                                            {{ floor((($item->price - $item->price_sale) / $item->price) * 100) }}%
                                                        </td>
                                                        <td class="text-center">
                                                            {{ number_format($item->price_sale * $item->quantity * 1000, 0, '.', '.') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            @if (isset($order) && $order->image != null)
                                <div class="row" style="margin-bottom:20px;">
                                    <div class="col-xs-4" style="box-sizing : border-box">
                                        <p class="lead">Sản phẩm đính kèm :</p>
                                        <div class="col-xs-12">
                                            <a target="_blank" href="{{ url('images/prescriptions/' . $order->image) }}"
                                                title="Xem đơn thuốc">
                                                <img style="width: 100%;"
                                                    src="{{ url('images/prescriptions/' . $order->image) }}" alt="">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-xs-4">

                                        <div class="table-responsive">
                                            <table class="table">
                                                @if ($order->promotion > 0)
                                                    <tr>
                                                        <th style="width:50%">Khuyến mại đơn hàng:</th>
                                                        <td>{{ $order->promotion }} %</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <th>Thành tiền (Đã bao gồm VAT):</th>
                                                    <td>
                                                        {{ number_format(($order->amount + $order->score_awards) * 1000, 0, '.', '.') }}
                                                        <span style="font-weight : 600;">VND</span>
                                                    </td>
                                                </tr>
                                                @if ($order->score_awards > 0)
                                                    {{-- <tr>
                    <th style="width:50%">Thanh toán bằng điểm:</th>
                    <td>{{number_format($order->score_awards*1000 ,0 ,'.' ,'.')}} <span style="font-weight : 600;">VND</td>
                  </tr> --}}
                                                @endif
                                                <tr>
                                                    <th>Số tiền phải thu:</th>
                                                    <td>
                                                        {{ number_format($order->amount * 1000, 0, '.', '.') }} <span
                                                            style="font-weight : 600;">VND</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            @else
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-xs-6">

                                        <div class="table-responsive">
                                            <table class="table">
                                                @if ($order->promotion > 0)
                                                    <tr>
                                                        <th style="width:50%">Khuyến mại đơn hàng:</th>
                                                        <td>{{ $order->promotion }} %</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <th>Thành tiền (Đã bao gồm VAT):</th>
                                                    <td>
                                                        {{ number_format(($order->amount + $order->score_awards) * 1000, 0, '.', '.') }}
                                                        <span style="font-weight : 600;">VND</span>
                                                    </td>
                                                </tr>
                                                @if ($order->score_awards > 0)
                                                    <tr>
                                                        <th style="width:50%">Thanh toán bằng điểm:</th>
                                                        <td>{{ number_format($order->score_awards * 1000, 0, '.', '.') }}
                                                            <span style="font-weight : 600;">VND</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <th>Số tiền phải thu:</th>
                                                    <td>
                                                        {{ number_format($order->amount * 1000, 0, '.', '.') }} <span
                                                            style="font-weight : 600;">VND</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        @endif
        <!-- /.row -->
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#list-users').DataTable({
                "lengthMenu": [
                    [25, 50, 100, 500, -1],
                    [25, 50, 100, 500, "All"]
                ],
                "order": [
                    [1, "asc"]
                ],
            });
        });
    </script>
    <script type="text/javascript">
        // delete
        $('.btn-delete').click(function() {
            if (confirm('Bạn có muốn xóa không?')) {
                var _this = $(this);
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'delete',
                    url: '/admin/user/tracking/' + id,
                    data: {
                        _token: $('[name="_token"]').val(),
                    },
                    success: function(response) {
                        _this.parent().parent().remove();
                    }
                })
            }
        });
    </script>
@endsection('js')
