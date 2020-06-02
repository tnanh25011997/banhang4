@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi Tiết Hóa Đơn
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->

                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên Sản Phẩm</th>
                                
                                <th>Ảnh</th>
                                <th>Số Lượng</th>
                                <th>Đơn Giá</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($billdetail as $bd)
                                <?php 
                                    $arrImg = json_decode($bd->product->image,true);
                                ?>
                                <tr class="odd gradeX" align="center">
                                    <td>{{$bd->id}}</td>
                                    <td>{{$bd->product->name}} {{$bd->color}}</td>
                                    
                                    <td><img src="source/images/{{$arrImg[0]}}" class="img-fluid" style="width: 100px;" alt=""></td>
                                    <td>{{$bd->quantity}}</td>
                                    <td>{{number_format($bd->unit_price)}}đ</td>
                                    
                                </tr>
                                
                            @endforeach
                           
                        </tbody>
                    </table>
                    <h2>THÔNG TIN KHÁCH HÀNG</h2>
                     <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên Khách Hàng</th>
                                <th>Email</th>
                                <th>Địa Chỉ</th>
                                <th>Số Điện Thoại</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            
                                
                                <tr class="odd gradeX" align="center">
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->phone_number}}</td>
                                    
                                </tr>
                                
                           
                           
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



@endsection