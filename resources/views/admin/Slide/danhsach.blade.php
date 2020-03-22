@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                                    <th>Ảnh</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slide as $s)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$s->id}}</td>
                                        <td><img src="source/images/{{$s->image}}" style="width: 200px;" alt=""></td>
                                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/Slide/xoa/{{$s->id}}"> Xóa</a></td>
                                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/Slide/sua/{{$s->id}}">Sửa</a></td>
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