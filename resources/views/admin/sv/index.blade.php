@extends('layouts.master')


@section('content')
    @if($listSV->total() > 0)
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
                @foreach($listSV as $sv)
                    <tr>
                        <td>{{ $sv->ma_sv }}</td>
                        <td>{{ $sv->ten_sv }}</td>
                        <td>{{ $sv->email }}</td>
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
                                    @foreach($sv->Phieu as $phieu)
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

        {!! $listSV->appends(request()->input())->links() !!}
    @else
        <div class="alert alert-danger">Không tìm thấy sinh viên</div>
    @endif
@endsection
