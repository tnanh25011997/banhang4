@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh Mục
                            <small>{{$category->name}}</small>
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
                        <form action="admin/Category/sua/{{$category->id}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Tên Danh Mục</label>
                                <input class="form-control" name="ten" placeholder="Điền tên loại sản phẩm" value="{{$category->name}}" />
                            </div>
                            <div class="form-group">
                                <label for="sel1">Nam/Nữ</label>
                                <select class="form-control" id="sel1" name="loai">
                                    <option @if($category->gender == 1) {{"selected"}} @endif >Nam</option>
                                    <option @if($category->gender == 0) {{"selected"}} @endif>Nữ</option>
                                    
                               </select>
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