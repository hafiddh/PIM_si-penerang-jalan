<x-app-layout title="Data Lampu">
    @section('css_datatable')
        <link href="{{ asset('') }}template/admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('') }}template/admin/vendor/select2/css/select2.min.css">
        <style>
            .select2-selection__rendered {
                color: white
            }

            .select2-search {
                color: white
            }

            .select2-search input {
                color: white
            }

            .select2-results {
                color: white
            }

            .select2-results__option--highlighted {
                color: white
            }

            .select2-results__option[aria-selected=true] {
                color: white
            }

            .select2 {
                color: white
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                top: 10px;
            }

            .select2-container--default .select2-selection--single {
                background-color: #171622;
                border-color: #DEDEE0;
                border-top-color: #DEDEE0;
                border-right-color-value: #DEDEE0;
                border-bottom-color: #DEDEE0;
                border-left-color-value: #DEDEE0;
                vertical-align: middle;
                height: 50px;
                width: 100%;
                padding: 10px 0 0 5px;
            }

            .select2-container--default .select2-selection--single .select2-selection__placeholder {
                color: white
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                color: white
            }
        </style>
    @endsection
    @section('content')
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah <Datag></Datag>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('add.light') }}" method="post">
                                @csrf
                                <div class="row">

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">IDPEL</label>
                                        <select class="default wide form-control wide mb-3 select2" id="idpel"
                                            name="idpel" required>
                                            <option value="" selected disabled>Pilih Panel</option>
                                            @foreach ($idpel as $data)
                                                <option value="{{ $data->id_idpel }}">{{ $data->idpel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">IDPEL NAME</label>
                                        <input type="text" class="form-control" placeholder="idpelname"
                                            id="sel_idpelname" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Kecamatan</label>
                                        <input type="text" class="form-control" placeholder="Kecamatan"
                                            id="sel_kecamatan" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Desa</label>
                                        <input type="text" class="form-control" placeholder="desa" id="sel_desa"
                                            disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Type</label>
                                        <select class="default wide form-control wide mb-3 select2" id="type"
                                            name="type" required>
                                            <option value="" selected disabled>Pilih Type</option>
                                            @foreach ($type as $data)
                                                <option value="{{ $data->id_type }}">{{ $data->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Merk</label>
                                        <select class="default wide form-control wide mb-3 select2" id="merk"
                                            name="merk" required>
                                            <option value="" selected disabled>Pilih Merek</option>
                                            @foreach ($merk as $data)
                                                <option value="{{ $data->id_merk }}">{{ $data->merk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Daya</label>
                                        <input type="text" class="form-control" placeholder="Penggunaan Daya"
                                            name="daya">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Tahun</label>
                                        <select class="default wide form-control wide mb-3 select2" id="tahun"
                                            name="tahun" required>
                                            <option value="" selected disabled>Pilih Tahun</option>
                                            @for ($year = 2010; $year <= 2030; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('vendor_and_js_datatable')
        <script src="{{ asset('') }}template/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('') }}template/admin/js/plugins-init/datatables.init.js"></script>
        <script src="{{ asset('') }}template/admin/vendor/select2/js/select2.full.min.js"></script>

        <script>
            $('.select2').select2();

            $('#idpel').on('change', function() {
                // alert(this.value);
                $.ajax({
                    url: "{{ route('admin.get.panel') }}",
                    type: 'get',
                    data: {
                        "id": this.value
                    },
                    success: function(response) {
                        // console.log(response)
                        $('#sel_idpelname').val(response.idpelname)
                        $('#sel_kecamatan').val(response.nama_kecamatan)
                        $('#sel_desa').val(response.nama_desa)
                    },
                    error: function(request, status, error) {
                        console.log(request.responseText);

                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
