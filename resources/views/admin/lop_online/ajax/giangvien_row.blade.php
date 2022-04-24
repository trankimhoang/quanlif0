<div class="p-2 mb-1 badge badge-pill badge-primary">
    #{{ $gv->ma_gv }} - {{ $gv->ten_gv }}
    <button data-id="{{ $gv->ma_gv }}" class="btn btn-danger btn-circle btn-sm btn-remove-gv"
            type="button">
        <i class="fas fa-trash"></i>
    </button>
    <input type="hidden"
           class="gv"
           name="gv[]"
           value="{{ $gv->ma_gv }}" data-id="{{ $gv->ma_gv }}">
</div>
