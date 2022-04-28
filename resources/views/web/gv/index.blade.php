@extends('layouts.app')
@section('title', 'Giang vien khai bao')

@section('content')
    <div class="container p-3">
        <h3 class="text-success text-center">Chào GV {{ $user->ten_gv }}, dưới đây là biểu mẫu khai báo tình trạng F0</h3>
        <div class="text-center">
            <a class="btn btn-danger" href="{{ route('logout_user_get') }}">Đăng xuất</a>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('gv.send_data') }}">
            @csrf
            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="text" class="form-control" id="name" value="{{ $user->ten_gv }}" readonly>
            </div>
            <div class="form-group">
                <label for="id">Mã GV</label>
                <input type="text" class="form-control" id="id" value="{{ $user->ma_gv }}" readonly>
            </div>

            <div class="table table-responsive">
                <table class="table table-bordered" id="table_lop">
                    <thead>
                    <th>Lớp</th>
                    <th>Chi tiết lớp</th>
                    <th>Hình thức dạy</th>
                    <th>Từ ngày</th>
                    <th>Đến ngày</th>
                    <th>Xóa</th>
                    </thead>
                    <tbody>
                    @foreach($user->LopHinhThucDay as $lopItem)
                        @include('web.gv.ajax.lop_row', compact('lopItem'))
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <button class="btn btn-primary" type="button" id="btn_add_lop">Thêm lớp</button>
            </div>

            @if(!$user->isBenh())
                <div class="form-group">
                    <label for="date_f0">Ngày bị</label>
                    <input type="datetime-local" class="form-control" id="date_f0" name="ngay_gio_bao_benh">
                </div>
            @else
                <div class="form-group">
                    <label for="ngay_gio_bao_khoi">Ngày khỏi</label>
                    <input type="datetime-local" class="form-control" id="ngay_gio_bao_khoi" name="ngay_gio_bao_khoi">
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function (){
            $('#btn_add_lop').click(function (){
               $('#table_lop').append(@json(view('web.gv.ajax.lop_row')->render()));
            });

            $('.btn-remove-lop').click(function (){
                $(this).parents('tr').remove();
            });
        });
    </script>
@endsection
