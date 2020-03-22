@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Brand
                    <small>List</small>
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
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tên Thương Hiệu</th>
                            <th>Nguồn Gốc</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brand as $br)
                        <tr class="odd gradeX" align="center">
                            <td>{{$br->id}}</td>
                            <td>{{$br->name}}</td>
                            <td>
                                {{$br->origin}}
                            </td>
                            <td class="center">


                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delBrand_{{$br->id}}">
                                  <i class="fa fa-trash-o  fa-fw"></i>
                                </button>
                                <div class="modal fade" id="delBrand_{{$br->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                                Bạn có thực sự muốn xóa {{$br->name}}?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="admin/Brand/xoa/{{$br->id}}"><button type="button" class="btn btn-primary">Xóa Luôn</button></a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/Brand/sua/{{$br->id}}">Sửa</a></td>
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