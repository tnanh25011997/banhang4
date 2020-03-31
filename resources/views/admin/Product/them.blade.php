@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản Phẩm
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
                        
                        @if(session('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <form action="admin/Product/them" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <label>Loại Sản Phẩm</label>
                                <select class="form-control" name="loaisp">
                                    @foreach($producttype as $pt)
                                    <option value="{{$pt->id}}">{{$pt->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thương Hiệu</label>
                                <select class="form-control" name="thuonghieu">
                                    @foreach($brand as $br)
                                    <option value="{{$br->id}}">{{$br->name}}</option>
                                    @endforeach        
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input class="form-control" name="ten" value="{{ old('ten') }}" placeholder="Nhập tên sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Mô Tả</label>
                                <textarea id="demo" class="form-control ckeditor" rows="3" name="mota">
                                {{ old('mota') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Giá Gốc</label>
                                <input class="form-control" type="number" name="giagoc" value="{{ old('giagoc') }}" placeholder="Nhập giá gốc" />
                            </div>
                            <div class="form-group">
                                <label>Giá Khuyến Mãi</label>
                                <input class="form-control" type="number" name="giakhuyenmai" value="{{ old('giakhuyenmai') }}" placeholder="Nhập giá khuyến mãi" />
                            </div>
                            <div class="form-group">
                                <label>Nam/nữ</label>
                                <select class="form-control" name="unit"> 
                                    <option value="nam">Nam</option>
                                    <option value="nu">Nữ</option> 
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" name="hinhanh">
                            </div>
                            
                            <button type="submit" class="btn btn-default">Thêm Sản Phẩm</button>
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