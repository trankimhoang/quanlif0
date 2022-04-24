@extends('layouts.master')


@section('content')
    @if($listGV->total() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" width="10%">Mã</th>
                    <th scope="col" width="20%">Tên</th>
                    <th scope="col" width="20%">Email</th>
                    <th scope="col" width="50%">
                        Lịch sử bệnh
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($listGV as $gv)
                    <tr>
                        <td>{{ $gv->ma_gv }}</td>
                        <td>{{ $gv->ten_gv }}</td>
                        <td>{{ $gv->email }}</td>
                        <td>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30%">Ngày bệnh</th>
                                        <th width="30%">Ngày khỏi</th>
                                        <th width="40%">Tình trạng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gv->Phieu as $phieu)
                                        <tr>
                                            <td>{{ $phieu->ngay_gio_bao_benh ?? '' }}</td>
                                            <td>{{ $phieu->ngay_gio_bao_khoi ?? '' }}</td>
                                            <td>{!! !empty($phieu->ngay_gio_bao_khoi) ? 'Đã khỏi' : '<font color="red">Đang bệnh</font>' !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $listGV->appends(request()->input())->links() !!}
    @else
        <div class="alert alert-danger">Không tìm thấy giảng viên</div>
    @endif
@endsection
