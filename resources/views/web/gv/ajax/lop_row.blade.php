@php
    $lops = \App\Models\LopMonHoc::all();
    $hts = \App\Models\HinhThucDay::all();
@endphp

<tr>
    <td>
        <select name="lop[]" class="form-control" required>
            <option value="" disabled selected>Chọn lớp</option>
            @foreach($lops as $lop)
                @if(!empty($lopItem) && $lop->ma_lop_mh == $lopItem->ma_lop_mh)
                    <option selected value="{{ $lop->ma_lop_mh }}">{{ $lop->ten }}</option>
                @else
                    <option value="{{ $lop->ma_lop_mh }}">{{ $lop->ten }}</option>
                @endif
            @endforeach
        </select>
    </td>
    <td>
        @if(!empty($lopItem))
            <a target="_blank" href="{{ route('gv.chi_tiet_lop', ['ma_lop_mh' => $lopItem->ma_lop_mh]) }}">Chi tiết</a>
        @endif
    </td>
    <td>
        <select name="ht[]" class="form-control" required>
            @foreach($hts as $ht)
                @if(!empty($lopItem) && $ht->ma_ht == $lopItem->pivot->ma_ht)
                    <option selected value="{{ $ht->ma_ht }}">{{ $ht->ten_ht }}</option>
                @else
                    <option value="{{ $ht->ma_ht }}">{{ $ht->ten_ht }}</option>
                @endif
            @endforeach
        </select>
    </td>
    <td>
        <input name="tu_ngay[]" type="date" value="{{ $lopItem->pivot->tu_ngay ?? '' }}" class="form-control" required>
    </td>
    <td>
        <input name="den_ngay[]" type="date" value="{{ $lopItem->pivot->den_ngay ?? '' }}" class="form-control" required>
    </td>
    <td>
        <button class="btn btn-danger btn-remove-lop" type="button">Xóa</button>
    </td>
</tr>
