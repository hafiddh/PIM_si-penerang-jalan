<x-app-layout title="Data Set - Komponen">
    @section('css_datatable')
        <link href="{{ asset('') }}template/admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    @endsection
    @section('content')
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ID PEL</h4>
                            <span class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#ModalInput">Add</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>IDPEL</th>
                                            <th>IDPEL NAME</th>
                                            <th>TARIF</th>
                                            <th>DAYA</th>
                                            <th>KOGOL</th>
                                            <th>DESA</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($idpel as $no => $data)
                                            <tr>
                                                <td>{{ $no + 1 }}</td>
                                                <td>{{ $data->kodeID }}</td>
                                                <td>{{ $data->idpel }}</td>
                                                <td>{{ $data->idpelname }}</td>
                                                <td>{{ $data->tarif }}</td>
                                                <td>{{ $data->daya }}</td>
                                                <td>{{ $data->kogol }}</td>
                                                <td>{{ $data->nama_desa }}</td>
                                                <td>
                                                    <div class="text-center">
                                                        <form action="{{ route('destroy.idpel', $data->id_idpel) }}"
                                                            method="post" onsubmit="return confirm('Hapus data?')">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#"
                                                                class="text-center btn btn-primary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#ModalUpdate-{{ $data->id_idpel }}"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <button type="submit"
                                                                class="text-center btn btn-danger shadow btn-xs sharp"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>

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
        <div class="modal fade" id="ModalInput">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('store.idpel') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="" class="form-label"><strong>Input IDPEL</strong></label>
                                <input type="number" class="form-control input-default " placeholder="input IDPEL"
                                    name="idpel" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label"><strong>Input IDPEL NAME</strong></label>
                                <input type="text" class="form-control input-default " placeholder="input IDPELNAME"
                                    name="idpelname" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label"><strong>Input Tarif</strong></label>
                                <select class="default wide form-control wide mt-3" name="tarif" required>
                                    <option value="" selected disabled>Select Default Tarif</option>
                                    <option value="P1">P1</option>
                                    <option value="P2">P2</option>
                                    <option value="P3">P3</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label"><strong>Input Daya</strong></label>
                                <input type="number" class="form-control input-default " placeholder="input Daya"
                                    name="daya" required>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label"><strong>Input Kogol</strong></label>
                                <select class="default wide form-control wide mt-3" name="kogol" required>
                                    <option value="" selected disabled>Select Kode Golongan</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label"><strong>Pilih Desa</strong></label>
                                <select class="default wide form-control wide mt-3" name="desa" required>
                                    <option value="" selected disabled>- Pilih Desa -</option>
                                    @foreach ($desa as $des)
                                        <option value="{{ $des->id_desa }}">{{ $des->nama_desa }}</option>
                                    @endforeach
                                </select>
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

        @foreach ($idpel as $data)
            <!-- Modal Update-->
            <div class="modal fade" id="ModalUpdate-{{ $data->id_idpel }}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{ route('update.idpel', $data->id_idpel) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="" class="form-label"><strong>IDPEL</strong></label>
                                    <input type="number" class="form-control input-default "
                                        value="{{ $data->idpel }}" name="idpel" required>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label"><strong>IDPEL NAME</strong></label>
                                    <input type="text" class="form-control input-default "
                                        value="{{ $data->idpelname }}" name="idpelname" required>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label"><strong>Kode Tarif</strong></label>
                                    <select class="default wide form-control wide mt-3" name="tarif" required>
                                        <option value="{{ $data->tarif }}">{{ $data->tarif }}</option>
                                        <option value="P1">P1</option>
                                        <option value="P2">P2</option>
                                        <option value="P3">P3</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label"><strong>Input Daya</strong></label>
                                    <input type="number" class="form-control input-default "
                                        value="{{ $data->daya }}" name="daya" required>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label"><strong>Input Kogol</strong></label>
                                    <select class="default wide form-control wide mt-3" name="kogol" required>
                                        <option value="{{ $data->kogol }}">{{ $data->kogol }}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label"><strong>Pilih Desa</strong></label>
                                    <select class="default wide form-control wide mt-3" name="desa" required>
                                        <option value="{{ $data->id_desa }}">{{ $data->nama_desa }}</option>
                                        @foreach ($desa as $des)
                                            <option value="{{ $des->id_desa }}">{{ $des->nama_desa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
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
    @endsection
</x-app-layout>
