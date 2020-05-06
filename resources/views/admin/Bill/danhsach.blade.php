@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row" style="margin-top: 20px;">
                    <a href="admin/Bill/danhsach">
                        <div class="col-sm-3" style="background-color: #e9e9e9; padding: 10px 10px; padding-top: 20px; border-right: 5px solid white;">

                            <div class="col-sm-8">
                               <p style="font-size: 20px;">Đơn Hàng Mới</p>
                                <h2>{{count($new_bill)}}</h2>
                            </div>
                            <div class="col-sm-4" style="text-align: center; height: 90px; font-size: 50px; background: #30A5FF; color: white;">
                                <i class="fa fa-shopping-cart fa-fw" style="padding-right: 10px; padding-top: 15px;"></i>
                            </div>
                            <div class="col-sm-12" style="text-align: center;border-top:1px dashed grey; margin-top: 40px; padding-top: 10px;">Xem chi tiết</div>
                        </div>
                    </a>
                    <a href="admin/Comments/danhsach">
                        <div class="col-sm-3" style="background-color: #e9e9e9; padding: 10px 10px; padding-top: 20px;  border-right: 5px solid white;">
                            <div class="col-sm-8">
                                <p style="font-size: 20px;">Bình Luận</p>
                                <h2>{{count($new_comments)}}</h2>
                            </div>
                            <div class="col-sm-4" style="text-align: center; height: 90px; font-size: 50px; background: #1ABC9C; color: white;">
                                <i class="fa fa-comment fa-fw" style="padding-top: 15px;"></i>
                            </div>
                            <div class="col-sm-12" style="text-align: center;border-top:1px dashed grey; margin-top: 40px; padding-top: 10px;">Xem chi tiết</div>

                        </div>
                     </a>
                    <a href="admin/Product/danhsach">
                        <div class="col-sm-3" style="background-color: #e9e9e9; padding: 10px 10px; padding-top: 20px;  border-right: 5px solid white;">
                            <div class="col-sm-8">
                                <p style="font-size: 20px;">Sản Phẩm</p>
                                <h2>{{count($product)}}</h2>
                            </div>
                            <div class="col-sm-4" style="text-align: center; height: 90px; font-size: 50px; background: #f36a5a; color: white;">
                                <i class="fa fa-cube fa-fw" style="padding-top: 15px;"></i>
                            </div>
                            <div class="col-sm-12" style="text-align: center;border-top:1px dashed grey; margin-top: 40px; padding-top: 10px;">Xem chi tiết</div>

                        </div>
                    </a>
                    <a href="admin/nguoidung/danhsach">
                        <div class="col-sm-3" style="background-color: #e9e9e9; padding: 10px 10px; padding-top: 20px;  border-right: 5px solid white;">
                            <div class="col-sm-8">
                                <p style="font-size: 20px;">Users</p>
                                <h2>{{count($nguoidung)}}</h2>
                            </div>
                            <div class="col-sm-4" style="text-align: center; height: 90px; font-size: 50px; background: orange; color: white;">
                                <i class="fa fa-users fa-fw" style="padding-top: 15px;"></i>
                            </div>
                            <div class="col-sm-12" style="text-align: center;border-top:1px dashed grey; margin-top: 40px; padding-top: 10px;">Xem chi tiết</div>

                        </div>
                    </a>
                    
                </div>
                <div class="row">

                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn Hàng
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th>Khách Hàng</th>
                                    <th>Ngày Đặt Hàng</th>
                                    <th>Tổng Tiền</th>
                                    <th>Hình Thức Thanh Toán</th>
                                    <th>Tình Trạng</th>
                                    <th>Chi Tiết</th>
                                    <th>Giao Hàng</th>
                                    <th>Xác Nhận</th>
                                    <th>Hủy Đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bill as $b)
                                    @if($b->tinhtrang != 1)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$b->id}}</td>
                                        <td>{{$b->customer->name}}</td>
                                        <td>{{$b->date_order}}</td>
                                        <td>{{number_format($b->total)}}đ</td>
                                        <td>{{$b->payment}}</td>
                                        <td>
                                            @if($b->tinhtrang == 0)
                                                Chưa Xác Nhận
                                            @else
                                                Đang Giao Hàng
                                            @endif
                                        </td>
                                        <td class="center"><i class="fa fa-pencil  fa-fw"></i><a href="admin/Bill/billdetail/{{$b->id}}"> Chi Tiết</a></td>
                                        <td>
                                            @if($b->tinhtrang == 0)
                                                <a href="admin/Bill/giaohang/{{$b->id}}">
                                                    <button class="btn btn-warning">Giao Hàng</button>
                                                </a>
                                            @else
                                                <a href="admin/Bill/huygiaohang/{{$b->id}}">
                                                    <button class="btn btn-warning">Hủy Giao</button>
                                                </a>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            <!-- <a href="admin/Bill/xacnhan/{{$b->id}}" class="btn btn-success">Xác Nhận</a> -->
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#veriBill_{{$b->id}}">
                                              Xác Nhận
                                            </button>
                                            <div class="modal fade" id="veriBill_{{$b->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                  
                                                        <div class="modal-body">
                                                        Bạn có thực sự muốn XÁC NHẬN BILL số {{$b->id}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="admin/Bill/xacnhan/{{$b->id}}"><button type="button" class="btn btn-primary">Có</button></a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleBill_{{$b->id}}">
                                              Hủy Đơn
                                            </button>
                                            <div class="modal fade" id="deleBill_{{$b->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                  
                                                        <div class="modal-body">
                                                        Bạn có thực sự muốn HỦY BILL số {{$b->id}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="admin/Bill/huybill/{{$b->id}}"><button type="button" class="btn btn-primary">Có</button></a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



@endsection