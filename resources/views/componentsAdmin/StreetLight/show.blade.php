<x-app-layout title="Data Lampu">
           @section('css_datatable')
           <link href="{{ asset('') }}template/admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
           @endsection
           @section('content')

            <div class="container-fluid">
			<div class="row">

            <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Database Lampu</h4>
                                <a href="{{route('store.light')}}"><span class="btn btn-primary btn-sm" >Add</span></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Lampu</th>
                                                <th>Type</th>
                                                <th>Merk</th>
                                                <th>Daya</th>
                                                <th>ID Panel</th>
                                                <th>Tahun</th>
                                                <th>Kecamatan</th>
                                                <th>Desa</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($light as $no => $data)
                                            <tr>
                                                <td>{{$no+1}}</td>
                                                <td>{{$data->kodeID}}</td>
                                                <td>{{$data->type}}</td>
                                                <td>{{$data->merk}}</td>
                                                <td>{{$data->daya}}</td>
                                                <td>{{$data->idpel}}</td>
                                                <td>{{$data->tahun}}</td>
                                                <td>{{$data->nama_kecamatan}}</td>
                                                <td>{{$data->nama_desa}}</td>
                                                <td>
													<div class="text-center">
                                                        <form action="{{route('delete.light', $data->id_lampu)}}" method="post" onsubmit="return confirm('Hapus data?')">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="{{route('show.update.light', $data->id_lampu)}}"  class="text-center btn btn-primary shadow btn-xs sharp me-1" ><i class="fa fa-pencil"></i></a>
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



            @endsection
            @section('vendor_and_js_datatable')
            <script src="{{ asset('') }}template/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
            <script src="{{ asset('') }}template/admin/js/plugins-init/datatables.init.js"></script>
            @endsection
           </x-app-layout>
