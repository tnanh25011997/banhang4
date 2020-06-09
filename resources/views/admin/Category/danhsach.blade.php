@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh Mục Sản Phẩm
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @if(session('thongbao'))
                           <div class="alert alert-success">{{session('thongbao')}}</div>
                        @endif
                        @if(session('thongbaoerr'))
                               <div class="alert alert-danger">{{session('thongbaoerr')}}</div>
                        @endif
                        <a href="admin/Category/them"><button type="button" class="btn btn-primary" style="float:right; margin-bottom: 10px;">Thêm Danh Mục</button></a>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Nam/Nữ</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $cate)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$cate->id}}</td>
                                        <td>{{$cate->name}}</td>
                                        <td>
                                            <?php
                                                if($cate->gender==0){
                                                    echo "Nữ";
                                                }else{
                                                    echo "Nam";
                                                }

                                            ?>
                                        </td>
                                        <td class="center">
                                            
                                            
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delPro_{{$cate->id}}">
                                              <i class="fa fa-trash-o  fa-fw"></i>
                                            </button>
                                            <div class="modal fade" id="delPro_{{$cate->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                  
                                                        <div class="modal-body">
                                                        Bạn có thực sự muốn xóa {{$cate->name}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="admin/Category/xoa/{{$cate->id}}"><button type="button" class="btn btn-primary">Xóa Luôn</button></a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="center">
                                            <a href="admin/Category/sua/{{$cate->id}}"><button class="btn btn-info"><i class="fa fa-pencil fa-fw"></i></button></a>
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