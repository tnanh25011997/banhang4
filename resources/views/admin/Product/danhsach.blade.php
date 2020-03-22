
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
                            <th>Xóa</th>
                            <th>Sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $sp)
                        <tr class="odd gradeX" align="center">
                            <td>{{$sp->id}}</td>
                            <td>{{$sp->name}}</td>
                            <td>{{$sp->product_type->name}}</td>
                            <td>{{$sp->brand->name}}</td>
                            <th>{{number_format($sp->unit_price)}}đ</th>
                            <th>{{number_format($sp->promotion_price)}}đ</th>
                            <th><img src="source/images/{{$sp->image}}" class="img-fluid" style="width: 100px;" alt=""></th>

                            <td class="center">

                                <!-- <a href="admin/Product/xoa/{{$sp->id}}"> Xóa</a> -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delPro_{{$sp->id}}">
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
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/Product/sua/{{$sp->id}}">Sửa</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            

</div>

</div>

</div>






@endsection