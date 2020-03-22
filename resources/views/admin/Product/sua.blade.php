@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản Phẩm
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <form action="admin/Product/sua/{{$product->id}}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <label>Loại Sản Phẩm</label>
                                <select class="form-control" name="loaisp">
                                    @foreach($producttype as $pt)
                                       <option 
                                       @if($product->product_type->id == $pt->id)
                                           {{"selected"}}
                                        @endif

                                        value="{{$pt->id}}">{{$pt->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thương Hiệu</label>
                                <select class="form-control" name="thuonghieu">
                                    @foreach($brand as $br)
                                       <option 
                                       @if($product->brand->id == $br->id)
                                           {{"selected"}}
                                        @endif

                                        value="{{$br->id}}">{{$br->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input class="form-control" name="ten" placeholder="Nhập tên sản phẩm" value="{{$product->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Mô Tả</label>
                                <textarea id="demo" class="form-control ckeditor" rows="3" name="mota" value="{{$product->description}}">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Giá Gốc</label>
                                <input class="form-control" type="number" name="giagoc" placeholder="Nhập giá gốc" value="{{$product->unit_price}}" />
                            </div>
                            <div class="form-group">
                                <label>Giá Khuyến Mãi</label>
                                <input class="form-control" type="number" name="giakhuyenmai" placeholder="Nhập giá khuyến mãi" value="{{$product->promotion_price}}" />
                            </div>
                            <div class="form-group">
                                <label>Nam/nữ</label>
                                <select class="form-control" name="unit">
                                  
                                    <option @if($product->unit=="nam") {{"selected"}} @endif value="nam">Nam</option>
                                    <option @if($product->unit=="nu") {{"selected"}} @endif value="nu">Nữ</option>
                                    
                                    
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Images</label>
                                <p><img src="source/images/{{$product->image}}" style="width: 200px"  alt=""></p>
                                <input type="file" name="hinhanh">
                            </div>
                            
                            <button type="submit" class="btn btn-default">Sửa Sản Phẩm</button>
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