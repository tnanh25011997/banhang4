@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @if(session('thongbao'))
                        <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <a href="admin/Slide/them"><button type="button" class="btn btn-primary" style="float:right; margin-bottom: 10px;">Thêm Slide</button></a>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Xóa</th>
                                    <th>Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slide as $s)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$s->id}}</td>
                                        <td><img src="source/images/{{$s->image}}" style="width: 200px;" alt=""></td>
                                        <td class="center">
                                            
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delSlide_{{$s->id}}">
                                                  <i class="fa fa-trash-o  fa-fw"></i>
                                            </button>
                                            <div class="modal fade" id="delSlide_{{$s->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                        Bạn có thực sự muốn xóa slide này?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="admin/Slide/xoa/{{$s->id}}"><button type="button" class="btn btn-primary">Xóa Luôn</button></a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="center">
                                            <a href="admin/Slide/sua/{{$s->id}}"><button class="btn btn-info"><i class="fa fa-pencil fa-fw"></i></button></a>
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