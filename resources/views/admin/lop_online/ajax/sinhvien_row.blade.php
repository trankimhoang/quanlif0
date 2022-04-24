<div class="p-2 mb-1 badge badge-pill badge-primary">
    #{{ $sv->ma_sv }} - {{ $sv->ten_sv }}
    <button data-id="{{ $sv->ma_sv }}" class="btn btn-danger btn-circle btn-sm btn-remove-sv"
            type="button">
        <i class="fas fa-trash"></i>
    </button>
    <input type="hidden"
           class="sv"
           data-is-old="1"
           name="sv[]"
           value="{{ $sv->ma_sv }}" data-id="{{ $sv->ma_sv }}">
</div>
