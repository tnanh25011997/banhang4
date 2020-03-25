@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Brand
                            <small>{{$brand->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    <li>{{$err}}</li>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                           <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <form action="admin/Brand/sua/{{$brand->id}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Tên Loại Sản Phẩm</label>
                                <input class="form-control" name="ten" placeholder="Nhập Tên Thương Hiệu" value="{{$brand->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Xuất Xứ</label>
                                <input class="form-control" name="xuatxu" placeholder="Nhập Xuất Xứ" value="{{$brand->origin}}" />
                            </div>
                            
                            
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Đặt Lại</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection