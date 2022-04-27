<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th nowrap>Mã GV</th>
            <th nowrap>Tên GV</th>
            <th nowrap>Hình thức phân công</th>
            <th nowrap>Từ ngày</th>
            <th nowrap>Đến ngày</th>
            <th nowrap>Xóa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($gvs as $gv)
            <tr>
                <td nowrap>{{ $gv->ma_gv }}</td>
                <td nowrap>{{ $gv->ten_gv }}</td>
                <td nowrap>{{ $maToTenHt[$gv->pivot->ma_ht] ?? '' }}</td>
                <td nowrap>{{ \Illuminate\Support\Carbon::parse($gv->pivot->tu_ngay)->format('d-m-Y') }}</td>
                <td nowrap>{{ \Illuminate\Support\Carbon::parse($gv->pivot->den_ngay)->format('d-m-Y') }}</td>
                <td nowrap>
                    <button data-id="{{ $gv->ma_gv }}"
                            data-ma-ht="{{ $gv->pivot->ma_ht }}"
                            data-tu-ngay="{{ \Illuminate\Support\Carbon::parse($gv->pivot->tu_ngay)->format('d-m-Y') }}"
                            data-den-ngay="{{ \Illuminate\Support\Carbon::parse($gv->pivot->den_ngay)->format('d-m-Y') }}"
                            class="btn btn-danger btn-circle btn-sm btn-remove-gv"
                            type="button">
                        <i class="fas fa-trash"></i>
                    </button>
                    <input type="hidden"
                           class="gv"
                           name="gv[]"
                           value="{{ $gv->ma_gv }}" data-id="{{ $gv->ma_gv }}">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
