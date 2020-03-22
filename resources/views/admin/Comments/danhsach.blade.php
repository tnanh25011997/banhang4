@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comments
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Sản Phẩm Comment</th>
                                    <th>Nội Dung</th>
                                    <th>Xác Nhận</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $cm)
                                    <tr>
                                        <td>{{$cm->id}}</td>
                                        <td>{{$cm->user->email}}</td>
                                        <td>{{$cm->product->name}}</td>
                                        <td>{{$cm->content}}</td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#veriCom_{{$cm->id}}">
                                              Xác Nhận
                                            </button>
                                            <div class="modal fade" id="veriCom_{{$cm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                  
                                                        <div class="modal-body">
                                                        Bạn có thực sự muốn XÁC NHẬN Comment số {{$cm->id}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="admin/Comments/xacnhan/{{$cm->id}}"><button type="button" class="btn btn-primary">Có</button></a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DelCom_{{$cm->id}}">
                                              Xóa
                                            </button>
                                            <div class="modal fade" id="DelCom_{{$cm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                  
                                                        <div class="modal-body">
                                                        Bạn có thực sự muốn XÓA Comment số {{$cm->id}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="admin/Comments/xoa/{{$cm->id}}"><button type="button" class="btn btn-primary">Có</button></a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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