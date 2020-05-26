@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->full_name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                   <li>{{$err}}</li>|
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        @if(Session::has('error'))
                                <div class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
                        <form action="admin/nguoidung/sua/{{$user->id}}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label>Họ Tên</label>
                                <input class="form-control" name="ten" placeholder="Nhập Họ Tên" value="{{$user->full_name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập Email" value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox"  id="changePassword" name="changePassword">
                                <label>Đổi Mật Khẩu</label>
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu Cũ</label>
                                <input class="form-control" name="old_password" id="oldpassword" type="password" placeholder="Nhập Mật Khẩu" disabled />
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu Mới</label>
                                <input class="form-control" name="password" id="password" type="password" placeholder="Nhập Mật Khẩu" disabled />
                            </div>
                            <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input class="form-control" name="re_password" id="password2" type="password" placeholder="Nhập Mật Khẩu" disabled />
                            </div>
                            <div class="form-group">
                                <label>Số Điện Thoại</label>
                                <input  class="form-control" name="sdt" placeholder="Nhập SĐT" value="{{$user->phone}}"/>
                            </div>
                            <div class="form-group">
                                <label>Địa Chỉ</label>
                                <input  class="form-control" name="diachi" placeholder="Nhập Địa Chỉ" value="{{$user->address}}"/>
                            </div>
                            <div class="form-group">
                                <label>Phân Quyền</label>
                                <label class="radio-inline">
                                    <input name="phanquyen" value="0" @if($user->level==0) {{"checked"}} @endif type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="phanquyen" value="1" @if($user->level==1) {{"checked"}} @endif  type="radio">Nhân Viên
                                </label>
                                <label class="radio-inline">
                                    <input name="phanquyen" value="2" @if($user->level==2) {{"checked"}} @endif  type="radio">Admin
                                </label>
                                
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

@section('script')
    <script>
        $(document).ready(function(){

            $("#changePassword").change(function() {

               if($(this).is(":checked"))
               {
                    $("#oldpassword").removeAttr('disabled');
                    $("#password").removeAttr('disabled');
                    $("#password2").removeAttr('disabled');

               }
               else
               {
                    $("#oldpassword").attr('disabled',"");
                    $("#password").attr('disabled', "");
                    $("#password2").attr('disabled', "");
               }
            });
        });
    </script>
@endsection