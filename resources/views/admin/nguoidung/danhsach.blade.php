@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       
                        <h1 class="page-header">User
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @if(session('thongbao'))
                            <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        <a href="admin/nguoidung/them"><button type="button" class="btn btn-primary" style="float:right; margin-bottom: 10px;">Thêm User</button></a>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Xoá</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $u)
                            <tr class="odd gradeX" align="center">
                                <td>{{$u->id}}</td>
                                <td>{{$u->full_name}}</td>
                                <td>{{$u->email}}</td>
                                <td>
                                    @if($u->level==2)
                                        {{"Admin"}}
                                    @elseif($u->level==1)
                                        {{"Nhân Viên"}}
                                    @else
                                        {{"Thường"}}
                                    @endif
                                </td>
                                    
                                <td>{{$u->phone}}</td>
                                <td>{{$u->address}}</td>
                                <td class="center">
                                    <!-- <a href="admin/nguoidung/xoa/{{$u->id}}"> Xóa</a> -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delUser_{{$u->id}}">
                                          <i class="fa fa-trash-o  fa-fw"></i>
                                    </button>
                                    <div class="modal fade" id="delUser_{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                Bạn có thực sự muốn xóa <b>{{$u->email}}</b>?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="admin/nguoidung/xoa/{{$u->id}}"><button type="button" class="btn btn-primary">Xóa Luôn</button></a>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="center">
                                    <a href="admin/nguoidung/sua/{{$u->id}}"><button class="btn btn-info"><i class="fa fa-pencil fa-fw"></i></button></a>
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