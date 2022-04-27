<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Mã GV</th>
            <th>Tên GV</th>
            <th>Hình thức phân công</th>
            <th>Từ ngày</th>
            <th>Đến ngày</th>
            <th>Xóa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($gvs as $gv)
            <tr>
                <td>{{ $gv->ma_gv }}</td>
                <td>{{ $gv->ten_gv }}</td>
                <td>{{ $maToTenHt[$gv->pivot->ma_ht] ?? '' }}</td>
                <td>{{ \Illuminate\Support\Carbon::parse($gv->pivot->tu_ngay)->format('d-m-Y') }}</td>
                <td>{{ \Illuminate\Support\Carbon::parse($gv->pivot->den_ngay)->format('d-m-Y') }}</td>
                <td>
                    <button data-id="{{ $gv->ma_gv }}" class="btn btn-danger btn-circle btn-sm btn-remove-gv"
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
