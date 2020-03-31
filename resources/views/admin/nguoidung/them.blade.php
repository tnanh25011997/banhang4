@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                   <li>{{$err}}</li>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <form action="admin/nguoidung/them" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label>Họ Tên</label>
                                <input class="form-control" name="ten" value="{{ old('ten') }}" placeholder="Nhập Họ Tên" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Nhập Email" />
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu</label>
                                <input class="form-control" name="password" type="password" placeholder="Nhập Mật Khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input class="form-control" name="re_password" type="password" placeholder="Nhập Mật Khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Số Điện Thoại</label>
                                <input  class="form-control" name="sdt" value="{{ old('sdt') }}" placeholder="Nhập SĐT" />
                            </div>
                            <div class="form-group">
                                <label>Địa Chỉ</label>
                                <input  class="form-control" name="diachi" value="{{ old('diachi') }}" placeholder="Nhập Địa Chỉ" />
                            </div>
                            <div class="form-group">
                                <label>Phân Quyền</label>
                                <label class="radio-inline">
                                    <input name="phanquyen" value="0" checked="" type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="phanquyen" value="1"  type="radio">Admin
                                </label>
                                
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
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