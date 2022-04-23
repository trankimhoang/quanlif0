@extends('layouts.app')
@section('title', 'Sinh vien khai bao')


@section('content')
    <div class="container p-3">
        <h3 class="text-success text-center">Chào bạn {{ $user->ten_sv }}, dưới đây là biểu mẫu khai báo tình trạng F0</h3>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('sv.send_data') }}">
            @csrf
            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="text" class="form-control" id="name" value="{{ $user->ten_sv }}" readonly>
            </div>
            <div class="form-group">
                <label for="id">MSSV</label>
                <input type="text" class="form-control" id="id" value="{{ $user->ma_sv }}" readonly>
            </div>
            <div class="form-group">
                <label for="class">Lớp</label>
                <input type="text" class="form-control" id="class" value="{{ $user->Lop->ten_lop }}" readonly>
            </div>
            <div class="form-group">
                <label for="date_f0">Ngày bị</label>
                <input type="datetime-local" class="form-control" id="date_f0" name="ngay_gio_bao_benh" required>
            </div>

            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
@endsection
