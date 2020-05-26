@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">Tin Tức
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <div class="col-lg-12">
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <a href="admin/tintuc/them"><button type="button" class="btn btn-primary" style="float:right; margin-bottom: 10px;">Thêm Tin Tức</button></a>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th style="width: 100px;">Title</th>
                                    <th style="width: 150px;">Highlight</th>
                                    <th>Ảnh</th>
                                    <th>Xoá</th>
                                    <th>Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tintuc as $t)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$t->id}}</td>
                                    <td>{{$t->title}}</td>
                                    <td>{{$t->highlight}}</td>
                                    <td><img src="source/images/{{$t->image}}" style="width: 200px; height: 150px;" alt=""></td>
                                  
                                    <td class="center">
                                        <!-- <a href="admin/tintuc/xoa/{{$t->id}}">Xóa</a> -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delNew_{{$t->id}}">
                                              <i class="fa fa-trash-o  fa-fw"></i>
                                        </button>
                                        <div class="modal fade" id="delNew_{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                              
                                                    <div class="modal-body">
                                                    Bạn có thực sự muốn xóa <b>{{$t->title}}</b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="admin/tintuc/xoa/{{$t->id}}"><button type="button" class="btn btn-primary">Xóa Luôn</button></a>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a href="admin/tintuc/sua/{{$t->id}}"><button class="btn btn-info"><i class="fa fa-pencil fa-fw"></i></button></a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



@endsection