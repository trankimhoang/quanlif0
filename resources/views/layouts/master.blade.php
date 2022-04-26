<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    @hasSection('title')
        <title>@yield('title') - {{ env('APP_NAME', '') }}</title>
    @else
        <title>{{ env('APP_NAME', '') }}</title>
@endif


    <!-- Custom fonts for this template-->
    <link href="{{ asset('/theme_admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('/theme_admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('link_css')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ env('APP_NAME', '') }}</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


    @foreach(config('menu_admin.menu') as $menu)
        <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::path() == 'admin' . $menu['url'] ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin' . $menu['url']) }}">
                    {!! $menu['icon'] !!}
                    <span>{{ $menu['title'] }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        @endforeach


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input name="search" type="text"
                               value="{{ request()->get('search') ?? '' }}"
                               class="form-control bg-light border-0 small"
                               placeholder="Tìm kiếm..." aria-label="Search"
                               aria-describedby="basic-addon2">
                        <select name="select_search" id="select_search" class="form-control bg-light border-0 small">
                            @if(\Request::route()->getName() == 'admin.sv')
                                <option selected value="{{ route('admin.sv') }}">Sinh viên</option>
                            @else
                                <option value="{{ route('admin.sv') }}">Sinh viên</option>
                            @endif
                            @if(\Request::route()->getName() == 'admin.gv')
                                <option selected value="{{ route('admin.gv') }}">Giảng viên</option>
                            @else
                                <option value="{{ route('admin.gv') }}">Giảng viên</option>
                            @endif

                            @if(\Request::route()->getName() == 'admin.ql_lop')
                                <option selected value="{{ route('admin.ql_lop') }}">Lớp Online</option>
                            @else
                                <option value="{{ route('admin.ql_lop') }}">Lớp Online</option>
                            @endif
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="btn_search">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Admin Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span
                                class="mr-2 d-none d-lg-inline text-gray-600 small">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                        </a>
                        <!-- Dropdown - Admin Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('logout_admin_get') }}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; {{ env('APP_NAME', '') }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="{{ asset('/theme_admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/theme_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('/theme_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/theme_admin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('/theme_admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/theme_admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('/theme_admin/js/demo/chart-pie-demo.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#btn_search').click(function () {
            let search = $('input[name="search"]').val();
            let url = $('#select_search').val();

            if (search != '') {
                window.location.replace(url + '?search=' + search);
            }
        });
    });
</script>
@yield('js')
</body>

</html>
