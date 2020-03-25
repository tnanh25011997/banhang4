@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <alert class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                   <li>{{$err}}</li>
                                @endforeach
                            </alert>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}<br><br></div>
                        @endif
                        <form action="admin/tintuc/sua/{{$tin->id}}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            
                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="tieude" value="{{$tin->title}}" placeholder="Nhập Tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Highlight</label>
                                <textarea class="form-control" name="highlight" rows="3" placeholder="Nhập Highlight" />{{$tin->highlight}}</textarea>
                            </div>
                           
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" class="form-control ckeditor"  rows="5" name="noidung">{{$tin->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <p><img src="source/images/{{$tin->image}}" style="width: 300px;" alt=""></p>
                                <input type="file" name="hinhanh">
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