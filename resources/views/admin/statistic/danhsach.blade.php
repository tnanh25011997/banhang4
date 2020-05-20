@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thống Kê
                            <small>List</small>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>DOANH SỐ BÁN HÀNG</h3>
                            <canvas id="myChartPie"></canvas>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr align="center">
                                        <th>Sản Phẩm</th>
                                        <th>Số Lượng Bán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seller as $sell)
                                    <tr  class="odd gradeX" align="center">
                                        <td>{{$sell->name}}</td>
                                        <th>{{$sell->soluong}}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="col-lg-12">
                            <!-- /.col-lg-12 -->
                            <form method="get" id="form-year">
                            <span>Năm:</span>
                            <select name="selectyear" class="sel-year">
                                
                                <option {{Request::get('selectyear')=="2020"?"selected='selected'":""}} value="2020">2020</option>
                                <option {{Request::get('selectyear')=="2019"?"selected='selected'":""}} value="2019">2019</option>
                            </select>
                             </form>
                            <h3>DOANH THU TRONG NĂM</h3>
                            <canvas id="myChart"></canvas>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr align="center">
                                        <th>Tháng</th>
                                        <th>Doanh Thu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($thongke as $key)
                                    <tr  class="odd gradeX" align="center">
                                        <th>{{$key->Thang}}</th>
                                        <th>{{number_format($key->Tong)}} VNĐ</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                   

                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            
        </div>
        <!-- /#page-wrapper -->

    <script>
        $(document).ready(function() {
            $('.sel-year').change(function() {
                $("#form-year").submit();
            });
        });
    </script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: [
                    @foreach($thongke as $key)
                    'Tháng '+{{$key->Thang}},
                    @endforeach
                ],
                datasets: [{
                    label: 'Doanh thu trong năm',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        @foreach($thongke as $key)
                        {{$key->Tong}},
                        @endforeach
                    ]
                }]
            },

            // Configuration options go here
            options: {}
        });


        var ctx = document.getElementById('myChartPie').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    @foreach($seller_top as $top)
                    '{{$top->name}}',
                    @endforeach
                    'Others'
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [
                        @foreach($seller_top as $top)
                            {{$top->soluong}},
                        @endforeach
                        {{$others}}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                
            }
        });
    </script>
    

@endsection