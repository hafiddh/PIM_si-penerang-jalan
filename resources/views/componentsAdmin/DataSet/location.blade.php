<x-app-layout title="Data Set - Location">
    @section('css_datatable')
        <link href="{{ asset('') }}template/admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    @endsection
    @section('content')
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Lokasi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabel_kec" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kecamatan</th>
                                            <th>Kecamatan ID</th>
                                            <th>Kelurahan / Desa</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($location as $no => $data)
                                            <tr>
                                                <td>{{ $no + 1 }}</td>
                                                <td>{{ $data->nama_kecamatan }}</td>
                                                <td>{{ $data->kode }}</td>
                                                <td>{{ $data->desa }} &nbsp;<a href="javascript:void(0);"><strong><i
                                                                class="fa fa-plus" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter-{{ $data->id_kecamatan }}"></i></strong></a>
                                                </td>
                                                <td>
                                                    <div class="d-flex text-center ">
                                                        <a href="#"
                                                            class="text-center btn btn-primary shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ModalUpdate-{{ $data->id_kecamatan }}"><i
                                                                class="fa fa-pencil"></i></a>
                                                        <a href="{{ route('location_desa', $data->nama_kecamatan) }}"
                                                            class="text-center btn btn-success shadow btn-xs sharp me-1"><i
                                                                class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Add-->
        @foreach ($location as $data)
            <div class="modal fade" id="exampleModalCenter-{{ $data->id_kecamatan }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{ route('store.location') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-2">
                                    <input type="text" class="form-control input-default"
                                        value="{{ $data->nama_kecamatan }}" disabled>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label"><strong>Nama Desa</strong></label>
                                    <input type="hidden" name="kecamatan" value="{{ $data->id_kecamatan }}">
                                    <input type="text" class="form-control input-default " placeholder="input nama desa"
                                        name="desa" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Edit Kecamatan-->
        @foreach ($location as $data)
            <div class="modal fade" id="ModalUpdate-{{ $data->id_kecamatan }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{ url('/datset/kecamatan', $data->nama_kecamatan) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="" class="form-label"><strong>Nama Kecamatan</strong></label>
                                    <input type="hidden" name="id" value="{{ $data->id_kecamatan }}">
                                    <input type="text" class="form-control input-default "
                                        value="{{ $data->nama_kecamatan }}" name="kecamatan" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
    @section('vendor_and_js_datatable')
        <script src="{{ asset('') }}template/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('') }}template/admin/js/plugins-init/datatables.init.js"></script>

        <script>
            $(document).ready(function() {
                $('#tabel_kec').DataTable();
            });
        </script>
    @endsection
</x-app-layout>
