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
                                <h4 class="card-title">Tarif KWH</h4>
                                <span class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalInput">Add</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tarif</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tarif as $no => $data)
                                            <tr>
                                                <td>{{$no+1}}</td>
                                                <td>{{$data->tarif}} &nbsp; KWH</td>
                                                <td>
													<div class="text-center">
                                                        <form action="{{route('destroy.tarif', $data->id_tarif)}}" method="post" onsubmit="return confirm('Hapus data?')">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="#"  class="text-center btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#ModalUpdate-{{$data->id_tarif}}"><i class="fa fa-pencil"></i></a>
                                                        <button type="submit" class="text-center btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
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
                        <form action="{{route('store.tarif')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="" class="form-label"><strong>Input Tarif KWH</strong></label>
                                <input type="number" class="form-control input-default " placeholder="input jumlah Tarif KWH" name="tarif" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            @foreach($tarif as $data)
            <!-- Modal Update-->
            <div class="modal fade" id="ModalUpdate-{{$data->id_tarif}}">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{route('update.tarif', $data->id_tarif)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="" class="form-label"><strong>Tarif KWH</strong></label>
                                <input type="text" class="form-control input-default" value="{{$data->tarif}}" name="tarif" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm light" data-bs-dismiss="modal">Close</button>
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
