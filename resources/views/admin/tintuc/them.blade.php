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
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                   <li>{{$err}}</li>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <form action="admin/tintuc/them" method="POST" enctype='multipart/form-data'>
                            @csrf
                            
                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="tieude" value="{{ old('tieude') }}" placeholder="Nhập Tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Highlight</label>
                                <textarea class="form-control" name="highlight" rows="3" placeholder="Nhập Highlight" />
                                    {{ old('highlight') }}
                                </textarea>
                            </div>
                           
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" class="form-control ckeditor" rows="5" name="noidung">
                                    {{ old('noidung') }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" name="hinhanh">
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