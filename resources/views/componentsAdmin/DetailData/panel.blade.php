<x-app-layout title="Data by Panel">
    @section('css_datatable')
        <link href="{{ asset('') }}template/admin/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('') }}template/admin/vendor/select2/css/select2.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('') }}template/admin/js/plugins-init//buttons.dataTables.min.css">

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

            .dataTables_wrapper .dt-buttons {
                float: none;
                text-align: right;
            }
        </style>
    @endsection
    @section('content')
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail by Panel</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <select class="select2" id="pilih_panel" style="color: white"></select>
                        </div>
                        <div class="card-body" id="table_hid">
                            <div class="table-responsive">
                                <table id="tabel_detail_panel" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Lampu</th>
                                            <th>Type</th>
                                            <th>Merk</th>
                                            <th>Daya</th>
                                            <th>ID Panel</th>
                                            <th>Kecamatan</th>
                                            <th>Desa</th>
                                        </tr>
                                    </thead>
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
        <script src="{{ asset('') }}template/admin/js/plugins-init/dataTables.buttons.min.js"></script>
        <script src="{{ asset('') }}template/admin/js/plugins-init/buttons.print.min.js"></script>
        <script src="{{ asset('') }}template/admin/vendor/select2/js/select2.full.min.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                $("#table_hid").hide();
            })

            $('#pilih_panel').select2({
                minimumInputLength: 3,
                language: {
                    inputTooShort: function() {
                        return "Ketik Nama atau ID Panel";
                    }
                },
                placeholder: 'Pilih Panel',
                ajax: {
                    url: "{{ route('panel.cari') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        // console.log(data);
                        return {

                            results: $.map(data, function(item) {
                                return {
                                    text: '' + item.idpelname + ' (' + item.idpel + ')',
                                    id: item.id_idpel
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#pilih_panel').change(() => {
                var id = $('#pilih_panel').val();
                loadData(id);
            })


            function loadData(id) {
                $("#tabel_detail_panel").DataTable({
                    paging: false,
                    destroy: true,
                    info: false,
                    searching: false,
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                    "ordering": false,
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'print',
                        className: 'btn btn-primary',
                        text: '<i class="fa fa-lg fa-print"></i> Print',
                        customize: function(win) {
                            $(win.document.body)
                                .css('font-size', '10pt');
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css({
                                    'font-size': '10pt',
                                    'font-weight': '100',
                                });
                            $(win.document.body).find('th')
                                .css({
                                    'font-size': '10pt',
                                    'font-weight': '300',
                                });
                            $(win.document.body).find('td')
                                .css({
                                    'font-size': '10pt',
                                    'font-weight': '100',
                                });
                            $(win.document.body).find('h1').css({
                                'font-size': '15pt',
                                'text-align': 'center',
                                'margin-bottom': '20px',
                            });

                            var last = null;
                            var current = null;
                            var bod = [];

                            var css = '@page { size: landscape; }',
                                head = win.document.head || win.document.getElementsByTagName('head')[0],
                                style = win.document.createElement('style');

                            style.type = 'text/css';
                            style.media = 'print';

                            if (style.styleSheet) {
                                style.styleSheet.cssText = css;
                            } else {
                                style.appendChild(win.document.createTextNode(css));
                            }

                            head.appendChild(style);
                        }
                    }],
                    ajax: {
                        url: "{{ route('get.panel.det') }}",
                        type: "get",
                        data: {
                            id: id,
                        },
                    },
                    columns: [{
                            data: null,
                            sortable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                        },
                        {
                            data: "kodeID",
                        },
                        {
                            data: "type",
                        },
                        {
                            data: "merk",
                        },
                        {
                            data: "daya",
                        },
                        {
                            data: "idpel",
                        },
                        {
                            data: "nama_kecamatan",
                        },
                        {
                            data: "nama_desa",
                        },
                    ],
                });

                $("#table_hid").show(200);
            }
        </script>
    @endsection
</x-app-layout>
