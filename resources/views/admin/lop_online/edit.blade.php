@extends('layouts.master')

@section('link_css')
    <link href="{{ asset('lib/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('lib/select2-bootstrap.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <form action="{{ route('admin.ql_lop.chinh_sua_post') }}" method="POST">
        <div class="row">
            <div class="col-md-6">
                @csrf
                <input type="hidden" name="ma_lop_mh" value="{{ $lop->ma_lop_mh }}">
                <div class="form-group">
                    <label for="id_zoom">Id zoom</label>
                    <input type="text" class="form-control" name="id_zoom" value="{{ $lop->id_zoom }}">
                </div>
                <div class="form-group">
                    <label for="id_zoom">Pass zoom</label>
                    <input type="text" class="form-control" name="pass_zoom" value="{{ $lop->pass_zoom }}">
                </div>
                <div class="form-group">
                    <label for="phong_hoc">Phòng học</label>
                    <input type="text" class="form-control" name="phong_hoc" value="{{ $lop->phong_hoc }}">
                </div>
                <div class="form-group">
                    <label for="ca_hoc">Ca học</label>
                    <input type="text" class="form-control" name="ca_hoc" value="{{ $lop->ca_hoc }}">
                </div>
                <div class="form-group">
                    <label for="thu">Thứ</label>
                    <input type="text" class="form-control" name="thu" value="{{ $lop->thu }}">
                </div>
                <div class="form-group">
                    <label for="thu">Host key zoom</label>
                    <input type="text" class="form-control" name="thu" value="{{ $lop->host_key_zoom }}">
                </div>

                <div class="form-group">
                    <label for="ma_mh">Môn học</label>
                    <select name="ma_mh" class="form-control form-select">
                        @foreach($listMonHoc as $monhoc)
                            @if($monhoc->ma_mh == $lop->ma_mh)
                                <option selected value="{{ $monhoc->ma_mh }}">{{ $monhoc->ten_mh }}</option>
                            @else
                                <option value="{{ $monhoc->ma_mh }}">{{ $monhoc->ten_mh }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <h1>Danh sách sinh viên</h1>
                <div id="div_sinhvien_loading" style="display: none;" class="spinner-border mb-2" role="status"> <span class="sr-only">Loading...</span> </div>
                <div id="div_sinhvien" class="mb-2">
                    @if(count($lop->SV) > 0)
                        @foreach($lop->SV as $sv)
                            @include('admin.lop_online.ajax.sinhvien_row', compact('sv'))
                        @endforeach
                    @else
                        <p class="alert alert-danger" id="sv_alert_not_found">Lớp không có sinh vien</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <select id="select_sv" class="select-search form-control form-select">
                                @foreach($listSV as $sv)
                                    <option value="{{ $sv->ma_sv }}">#{{ $sv->ma_sv }} - {{ $sv->ten_sv }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button class="btn btn-primary w-100" id="btn-add-sv" type="button">Thêm sinh viên</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('lib/select2.min.js') }}"></script>
    <script>
        $(document).ready(function (){
            $('#div_sinhvien_loading').hide();

            $('body').on('click', '.btn-remove-sv', function (){
                let id = $(this).attr('data-id');
                $(this).parent().remove();

                $.ajax({
                    url: @json(route('admin.ql_lop.remove_sv')),
                    data: {
                        ma_lop_mh: @json($lop->ma_lop_mh),
                        ma_sv: id
                    },
                    method: 'GET',
                    success: function () {

                    }
                })
            });

            $( "#select_sv" ).select2({
                theme: "bootstrap"
            });

            $('#btn-add-sv').click(function (){
                let id = $('#select_sv option:selected').val();
                $('#div_sinhvien').hide();
                $('#div_sinhvien_loading').show();
                $(this).prop('disabled', true);
                $('#sv_alert_not_found').remove();

                $.ajax({
                    url: @json(route('admin.ql_lop.add_sv')),
                    data: {
                        ma_lop_mh: @json($lop->ma_lop_mh),
                        ma_sv: id
                    },
                    method: 'GET',
                    success: function (data) {
                        $('#div_sinhvien').append(data);
                        $('#div_sinhvien_loading').hide();
                        $('#div_sinhvien').show();
                        $('#btn-add-sv').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
