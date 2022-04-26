@extends('layouts.app')
@section('title', 'Giang vien khai bao')


@section('content')
    <div class="container p-3">
        <h3 class="text-success text-center">Chào GV {{ $user->ten_sv }}, dưới đây là biểu mẫu khai báo tình trạng F0</h3>
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
{{--            <div class="form-group">--}}
{{--                <label for="class">Lớp</label>--}}
{{--                <input type="text" class="form-control" id="class" value="{{ $user->Lop->ten_lop }}" readonly>--}}
{{--            </div>--}}
            @if(!$user->isBenh())
                <div class="form-group">
                    <label for="date_f0">Ngày bị</label>
                    <input type="datetime-local" class="form-control" id="date_f0" name="ngay_gio_bao_benh" required>
                </div>
            @else
                <div class="form-group">
                    <label for="ngay_gio_bao_khoi">Ngày khỏi</label>
                    <input type="datetime-local" class="form-control" id="ngay_gio_bao_khoi" name="ngay_gio_bao_khoi" required>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
@endsection
