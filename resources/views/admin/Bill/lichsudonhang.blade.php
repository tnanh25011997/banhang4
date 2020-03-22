@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bill
                            <small>List</small>
                        </h1>
                    </div>
                    <h3>LỊCH SỬ ĐƠN HÀNG</h3>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>ID_Customer </th>
                                <th>Ngày Đặt Hàng</th>
                                <th>Tổng Tiền</th>
                                <th>Hình Thức Thanh Toán</th>
                                <th>Tình Trạng</th>
                                <th>Chi Tiết</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill as $b)
                                
                                <tr class="odd gradeX" align="center">
                                    <td>{{$b->id}}</td>
                                    <td>{{$b->customer->name}}</td>
                                    <td>{{$b->date_order}}</td>
                                    <td>{{number_format($b->total)}}đ</td>
                                    <td>{{$b->payment}}</td>
                                    <td>Đã Xác Nhận</td>
                                    <td class="center"><i class="fa fa-pencil  fa-fw"></i><a href="admin/Bill/billdetail/{{$b->id}}"> Chi Tiết</a></td>
                                    
                                </tr>
                               
                            @endforeach
                           
                        </tbody>
                    </table>
                    <!-- /.col-lg-12 -->
                    <h3>DOANH THU TRONG NĂM</h3>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Tháng</th>
                                <th>Doanh Thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($thongke as $key)
                            <tr  class="odd gradeX" align="center">
                                <th>{{$key->Thang}}</th>
                                <th>{{number_format($key->Tong)}} VNĐ</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



@endsection