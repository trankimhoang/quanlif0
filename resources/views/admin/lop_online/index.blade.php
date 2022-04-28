@extends('layouts.master')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if($listLop->total() > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" nowrap>Mã</th>
                <th scope="col" nowrap>Tên</th>
                <th scope="col" nowrap>Id zoom</th>
                <th scope="col" nowrap>Pass zoom</th>
                <th scope="col" nowrap>Phòng học</th>
                <th scope="col" nowrap>Ca học</th>
                <th scope="col" nowrap>Thứ</th>
                <th scope="col" nowrap>Host key zoom</th>
                <th scope="col" nowrap>Môn học</th>
                <th scope="col" nowrap>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listLop as $lop)
                <tr>
                    <td nowrap>{{ $lop->ma_lop_mh }}</td>
                    <td nowrap>{{ $lop->ten }}</td>
                    <td nowrap>{{ $lop->id_zoom }}</td>
                    <td nowrap>{{ $lop->pass_zoom }}</td>
                    <td nowrap>{{ $lop->phong_hoc }}</td>
                    <td nowrap>{{ $lop->ca_hoc }}</td>
                    <td nowrap>{{ $lop->thu }}</td>
                    <td nowrap>{{ $lop->host_key_zoom }}</td>
                    <td nowrap>{{ $lop->MonHoc->ten_mh }}</td>
                    <td nowrap>
                        <form action="{{ route('admin.ql_lop.xoa') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="ma_lop_mh" value="{{ $lop->ma_lop_mh }}">
                            <button data-id="{{ $lop->ma_lop_mh }}" class="btn btn-danger btn-remove-class" type="submit">Xóa</button>
                        </form>
                        <a class="btn btn-primary" href="{{ route('admin.ql_lop.chinh_sua', ['ma_lop_mh' => $lop->ma_lop_mh]) }}">Chỉnh sửa</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $listLop->appends(request()->input())->links() !!}
    @else
        <div class="alert alert-danger">Không tìm thấy lớp học</div>
    @endif
@endsection

@section('js')
    <script>
        $(document).ready(function (){

            $('.btn-remove-class').click(function (event){
                event.preventDefault();

                if (confirm('Bạn có chắc chắn xóa lớp ' + $(this).attr('data-id') + ' không ?')) {
                    $(this).parent().submit();
                }
            });
        });
    </script>
@endsection
