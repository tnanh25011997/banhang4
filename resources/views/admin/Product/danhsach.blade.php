
@extends('admin.layout.index')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản Phẩm
                    <small>Danh Sách</small>
                </h1>
            </div>
            <div class="col-lg-12">
                @if(session('thongbao'))
                <div class="alert alert-success">{{session('thongbao')}}</div>
                @endif
                <a href="admin/Product/them"><button type="button" class="btn btn-primary" style="float:right; margin-bottom: 10px;">Thêm Sản Phẩm</button></a>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Loại Sản Phẩm</th>
                            <th>Thương Hiệu</th>
                            <th>Giá Gốc</th>
                            <th>Giá Khuyến Mãi</th>
                            <th>Ảnh</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                            <th>Xóa</th>
                            <th>Sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $sp)
                        <?php 
                            $arrSaleImg = json_decode($sp->image,true);
                        ?>
                        <tr class="odd gradeX" align="center">
                            <td>{{$sp->id}}</td>
                            <td>{{$sp->name}}</td>
                            <td>{{$sp->product_type->name}}</td>
                            <td>{{$sp->brand->name}}</td>
                            <th>{{number_format($sp->unit_price)}}đ</th>
                            <th>{{number_format($sp->promotion_price)}}đ</th>
                            <th><img src="source/images/{{$arrSaleImg[0]}}" class="img-fluid" style="width: 100px;" alt=""></th>
                            <th>
                                <p style="background-color: yellow;">
                                <?php 
                                    if ($sp->status==1) {
                                        echo 'Còn Hàng';
                                    } else if($sp->status==2) {
                                        echo 'Hết Hàng';
                                    } else {
                                        echo 'Ngừng Kinh Doanh';
                                    }
                                ?>
                                </p>
                                    
                            </th>
                            <td>
                                <?php 
                                    if ($sp->status==1) {
                                ?>  <a href="admin/Product/het-hang/{{$sp->id}}"><button style="width: 145px; margin-bottom: 10px;" class="btn btn-warning">Hết Hàng</button></a><br>
                                    <a href="admin/Product/ngung-kinh-doanh/{{$sp->id}}"><button class="btn btn-primary">Ngừng Kinh Doanh</button></a>
                                <?php
                                    } else if($sp->status==2) {
                                ?> <a href="admin/Product/con-hang/{{$sp->id}}"><button style="width: 145px; margin-bottom: 10px;" class="btn btn-success">Còn Hàng</button></a><br>
                                   <a href="admin/Product/ngung-kinh-doanh/{{$sp->id}}"><button class="btn btn-primary">Ngừng Kinh Doanh</button></a>
                                <?php 
                                    } else {
                                ?> <a href="admin/Product/con-hang/{{$sp->id}}"><button class="btn btn-Info">Kinh Doanh</button></a>
                                <?php 
                                    }
                                ?>
                            </td>
                            <td class="center">

                                <!-- <a href="admin/Product/xoa/{{$sp->id}}"> Xóa</a> -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delPro_{{$sp->id}}">
                                  <i class="fa fa-trash-o  fa-fw"></i>
                                </button>
                                <div class="modal fade" id="delPro_{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      
                                        <div class="modal-body">
                                        Bạn có thực sự muốn xóa {{$sp->name}}?
                                        </div>
                                        <div class="modal-footer">
                                            <a href="admin/Product/xoa/{{$sp->id}}"><button type="button" class="btn btn-primary">Xóa Luôn</button></a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                            
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                        <td class="center"><a href="admin/Product/sua/{{$sp->id}}"><button class="btn btn-info"> <i class="fa fa-pencil fa-fw"></i></button></a>
                            
                        </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            

</div>

</div>

</div>






@endsection