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
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>DOANH SỐ BÁN HÀNG</h3>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr align="center">
                                        <th>Sản Phẩm</th>
                                        <th>Số Lượng Bán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seller as $sell)
                                    <tr  class="odd gradeX" align="center">
                                        <td>{{$sell->name}}</td>
                                        <th>{{$sell->soluong}}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
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
                    </div>
                   

                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



@endsection