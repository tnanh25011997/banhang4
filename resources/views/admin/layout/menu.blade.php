<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        @if(Auth::user()->level==2)
                        <li>
                            <a href="admin/Brand/danhsach"><i class="fa fa-youtube fa-fw"></i> Thương Hiệu<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/Brand/danhsach">Danh Sách Thương Hiệu</a>
                                </li>
                                <li>
                                    <a href="admin/Brand/them">Thêm Thương Hiệu</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        @if(Auth::user()->level==2)
                        <li>
                            <a href="admin/ProductType/danhsach"><i class="fa fa-bar-chart-o fa-fw"></i> Loại Sản Phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/ProductType/danhsach">Danh Sách Loại Sản Phẩm</a>
                                </li>
                                <li>
                                    <a href="admin/ProductType/them">Thêm Loại Sản Phẩm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        @if(Auth::user()->level==2)
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Sản Phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/Product/danhsach">Danh Sách Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="admin/Product/them">Thêm Sản Phẩm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        @if(Auth::user()->level==2)
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/nguoidung/danhsach">Danh Sách User</a>
                                </li>
                                <li>
                                    <a href="admin/nguoidung/them">Thêm User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif

                        <li>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Đơn Hàng<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/Bill/danhsach">Danh Sách Đơn Hàng</a>
                                </li>
                                <li>
                                    <a href="admin/Bill/lichsudonhang">Lịch Sử Đơn Hàng</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @if(Auth::user()->level==2)
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Thống Kê<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/thong-ke/danhsach">Doanh Thu</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Slide<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/Slide/danhsach">Danh Sách Slide</a>
                                </li>
                                <li>
                                    <a href="admin/Slide/them">Thêm Slide</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file fa-fw"></i> Tin Tức<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/tintuc/danhsach">Danh Sách Tin Tức</a>
                                </li>
                                <li>
                                    <a href="admin/tintuc/them">Thêm Tin Tức</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-comment fa-fw"></i> Comments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/Comments/danhsach">Duyệt Comments</a>
                                </li>
                                <li>
                                    <a href="admin/Comments/danh-sach-comments">Danh Sách Comments</a>
                                </li>
                                <li>
                                    <a href="admin/Comments/danhsachnhankhuyenmai">Nhận Tin Khuyến Mãi</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->