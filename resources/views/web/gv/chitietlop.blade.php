@extends('layouts.app')
@section('title', 'Chi tiết lớp')


@section('content')
    <div>
        <p>Tên: {{ $lop->ten }}</p>
        <p>Id zoom: {{ $lop->id_zoom }}</p>
        <p>Pass zoom: {{ $lop->pass_zoom }}</p>
        <p>Phòng học: {{ $lop->phong_hoc }}</p>
        <p>Ca học: {{ $lop->ca_hoc }}</p>
        <p>Thứ: {{ $lop->thu }}</p>
        <p>Host key zoom: {{ $lop->host_key_zoom }}</p>
        <p>Môn học: {{ $lop->MonHoc->ten_mh }}</p>
    </div>
@endsection
