<x-app-layout title="Detail Tagihan">
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
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Tagihan Panel</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="default-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#jam"><i
                                                class="la la-stopwatch me-2"></i> by Jam Nyala</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#daya"><i
                                                class="la la-plug me-2"></i> by Daya</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="jam" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header m-3">
                                                <select class="select2" id="pilih_panel" style="color: white"></select>
                                            </div>
                                            <div class="card-body" id="div_jam">
                                                <div class="table-responsive">
                                                    <table id="tabel_tagihan_by_jam" class="display"
                                                        style="min-width: 100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:1%">No</th>
                                                                <th>ID Panel</th>
                                                                <th>Nama Panel</th>
                                                                <th style="width:1%">Tarif /KWH</th>
                                                                <th style="width:1%">Total Daya</th>
                                                                <th style="width:1%">Jam Nyala</th>
                                                                <th style="width:200px;">&nbsp;&nbsp;&nbsp;Tagihan
                                                                    &nbsp;&nbsp;&nbsp;</th>
                                                                <th style="width:200px;">&nbsp;Tagihan PLN&nbsp;</th>
                                                                <th style="width:200px;">
                                                                    &nbsp;&nbsp;Perbandingan&nbsp;&nbsp;</th>
                                                                <th style="width:1%">Bulan</th>
                                                                <th style="width:1%">Tahun</th>
                                                                <th style="width:1%"></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="daya">
                                        <div class="tab-pane fade show active" id="daya" role="tabpanel">
                                            <div class="card">
                                                <div class="card-header m-3">
                                                    <select class="select2" id="pilih_panel_daya"
                                                        style="color: white"></select>
                                                </div>
                                                <div class="card-body" id="div_daya">
                                                    <div class="table-responsive">
                                                        <table id="tabel_tagihan_by_daya" class="display"
                                                            style="min-width: 100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>ID Panel</th>
                                                                    <th>Nama Panel</th>
                                                                    <th>Tarif /KWH</th>
                                                                    <th>Daya Awal</th>
                                                                    <th>Daya Akhir</th>
                                                                    <th style="width:200px;">&nbsp;&nbsp;&nbsp;Tagihan
                                                                        &nbsp;&nbsp;&nbsp;</th>
                                                                    <th style="width:200px;">&nbsp;Tagihan PLN&nbsp;</th>
                                                                    <th style="width:200px;">
                                                                        &nbsp;&nbsp;Perbandingan&nbsp;&nbsp;</th>
                                                                    <th style="width:1%">Bulan</th>
                                                                    <th style="width:1%">Tahun</th>
                                                                    <th style="width:1%"></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_view" data-backdrop="static" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Tagihan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body" id="div_print_1">
                        <dl class="row mb-3">
                            <dt class="col-sm-3">ID Panel</dt>
                            <dd class="col-sm-9"><b><span id="v_id_panel"></span></b></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Nama Panel</dt>
                            <dd class="col-sm-9"><span id="v_nama_panel"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Tarif /KWH</dt>
                            <dd class="col-sm-9"><span id="v_tarif"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Daya Awal</dt>
                            <dd class="col-sm-9"><span id="v_daya_aw"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Daya Akhir</dt>
                            <dd class="col-sm-9"><span id="v_daya_ak"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Tagihan</dt>
                            <dd class="col-sm-9"><span id="v_tag"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Bulan</dt>
                            <dd class="col-sm-9"><span id="v_bulan"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Tahun</dt>
                            <dd class="col-sm-9"><span id="v_tahun"></span></dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light btn-sm" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button"id="btn_print_1"  class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</button> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_view_2" data-backdrop="static" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Tagihan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body" id="div_print_2">
                        <dl class="row mb-3">
                            <dt class="col-sm-3">ID Panel</dt>
                            <dd class="col-sm-9"><b><span id="v_id_panel_1"></span></b></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Nama Panel</dt>
                            <dd class="col-sm-9"><span id="v_nama_panel_1"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Tarif /KWH</dt>
                            <dd class="col-sm-9"><span id="v_tarif_1"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Total Daya</dt>
                            <dd class="col-sm-9"><span id="v_total_daya"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Jam Nyala</dt>
                            <dd class="col-sm-9"><span id="v_jam_nyala"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Realisasi Tagihan PLN</dt>
                            <dd class="col-sm-9"><span id="v_realisasi_pln"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Tagihan</dt>
                            <dd class="col-sm-9"><span id="v_tag_1"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Perbandingan tagihan</dt>
                            <dd class="col-sm-9"><span id="v_tag_2"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Bulan</dt>
                            <dd class="col-sm-9"><span id="v_bulan_1"></span></dd>
                        </dl>
                        <dl class="row mb-3">
                            <dt class="col-sm-3">Tahun</dt>
                            <dd class="col-sm-9"><span id="v_tahun_1"></span></dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light btn-sm" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" id="btn_print_2" class="btn btn-primary btn-sm"><i
                                class="fa fa-print"></i> Print</button> --}}
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
                $('#div_daya').hide();
                $('#div_jam').hide();

                $('#pilih_panel').select2({
                    minimumInputLength: 3,
                    language: {
                        inputTooShort: function() {
                            return "";
                        }
                    },
                    placeholder: 'Pilih panel',
                    ajax: {
                        url: "{{ route('panel.cari.jam') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            console.log(data);
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: '' + item.idpel + ' (' + item.idpelname + ')',
                                        id: item.idpanel
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });

                $('#pilih_panel_daya').select2({
                    minimumInputLength: 3,
                    language: {
                        inputTooShort: function() {
                            return "";
                        }
                    },
                    placeholder: 'Pilih panel',
                    ajax: {
                        url: "{{ route('panel.cari.daya') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            // console.log(data);
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: '' + item.idpel + ' (' + item.idpelname + ')',
                                        id: item.idpanel
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            })

            $('#pilih_panel').change(() => {
                var id = $('#pilih_panel').val();
                loadData(id);
            })

            $('#pilih_panel_daya').change(() => {
                var id = $('#pilih_panel_daya').val();
                loadData2(id);
            })

            $("#btn_print_2").click(() => {
                print2();
            })

            function print2() {
                var divToPrint = document.getElementById('div_print_2');
                var newWin = window.open('', 'Print-Window');
                newWin.document.open();
                newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function() {
                    newWin.close();
                }, 10);
            }

            $("#btn_print_1").click(() => {
                print1();
            })

            function print1() {
                var divToPrint = document.getElementById('div_print_1');
                var newWin = window.open('', 'Print-Window');
                newWin.document.open();
                newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function() {
                    newWin.close();
                }, 10);
            }

            function loadData(id) {
                $("#tabel_tagihan_by_jam").DataTable({
                    paging: false,
                    responsive: true,
                    destroy: true,
                    info: false,
                    searching: false,
                    autoWidth: true,
                    processing: true,
                    serverSide: true,
                    "ordering": true,
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
                                'font-size': '14pt',
                                'text-align': 'center',
                                'font-weight': '500',
                                'margin-bottom': '20px',
                            });
                            $(win.document.body).find('h1').text("Detail Tagihan Panel (Jam)");

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
                        url: "{{ route('panel.get.tagihan.jam') }}",
                        type: "get",
                        data: {
                            id: id,
                        },
                        // success: function(data) {
                        //     console.log(data);
                        // },
                    },
                    columns: [{
                            data: null,
                            sortable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                        },
                        {
                            data: "idpel",
                        },
                        {
                            data: "idpelname",
                        },
                        {
                            data: "tarif_kwh",
                        },
                        {
                            data: "total_daya",
                        },
                        {
                            data: "jam_nyala",
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return "Rp. " + format(data.tagihan);
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                if (data.realisasi_pln == null) {
                                    return "-";
                                }
                                return "Rp. " + format(data.realisasi_pln);
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {

                                if (data.realisasi_pln == null) {
                                    return "-";
                                }
                                if (data.realisasi_pln - data.tagihan < 0) {
                                    return "Rp. -" + format(data.tagihan - data.realisasi_pln);
                                } else {
                                    return "Rp. -" + format(data.realisasi_pln - data.tagihan);
                                }

                            }
                        },
                        {
                            data: "bulan",
                        },
                        {
                            data: "tahun",
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return "<button class='btn btn-sm btn-success' style='margin-bottom:3px;width:50px;' id='" +
                                    data.id +
                                    "' title='Detail' onClick='data_detail_2(this.id)'> <i class='fa fa-eye'></i> </button>"
                            }
                        },
                    ],
                    columnDefs: [{
                        className: 'text-center',
                        targets: [3, 4, 5, 6, 7, 8, 9]
                    }],
                });

                $("#div_jam").show(200);
            }

            function loadData2(id) {
                // console.log(id);
                $("#tabel_tagihan_by_daya").DataTable({
                    paging: false,
                    responsive: true,
                    destroy: true,
                    info: false,
                    searching: false,
                    autoWidth: true,
                    processing: true,
                    serverSide: true,
                    "ordering": true,
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
                                'font-size': '14pt',
                                'text-align': 'center',
                                'font-weight': '500',
                                'margin-bottom': '20px',
                            });
                            $(win.document.body).find('h1').text("Detail Tagihan Panel (Daya)");

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
                        url: "{{ route('panel.get.tagihan.daya') }}",
                        type: "get",
                        data: {
                            id: id,
                        },
                        // success: function(data) {
                        //     console.log(data);
                        // },
                    },
                    columns: [{
                            data: null,
                            sortable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                        },
                        {
                            data: "idpel",
                        },
                        {
                            data: "idpelname",
                        },
                        {
                            data: "tarif_kwh",
                        },
                        {
                            data: "daya_awal",
                        },
                        {
                            data: "daya_akhir",
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return "Rp. " + format(data.tagihan);
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                if (data.realisasi_pln == null) {
                                    return "-";
                                }
                                return "Rp. " + format(data.realisasi_pln);
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                if (data.realisasi_pln == null) {
                                    return "-";
                                }
                                if (data.realisasi_pln - data.tagihan < 0) {
                                    return "Rp. -" + format(data.tagihan - data.realisasi_pln);
                                } else {
                                    return "Rp. -" + format(data.realisasi_pln - data.tagihan);
                                }

                            }
                        },
                        {
                            data: "bulan",
                        },
                        {
                            data: "tahun",
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return "<button class='btn btn-sm btn-success' style='margin-bottom:3px;width:50px;' id='" +
                                    data.id +
                                    "' title='Detail' onClick='data_detail(this.id)'> <i class='fa fa-eye'></i> </button>"
                            }
                        },
                    ],
                    columnDefs: [{
                        className: 'text-center',
                        targets: [3, 4, 5, 6, 7, 8, 9, 10]
                    }],
                });

                $("#div_daya").show(200);
            }

            var format = function(num) {
                var str = num.toString().replace("", ""),
                    parts = false,
                    output = [],
                    i = 1,
                    formatted = null;
                if (str.indexOf(".") > 0) {
                    parts = str.split(".");
                    str = parts[0];
                }
                str = str.split("").reverse();
                for (var j = 0, len = str.length; j < len; j++) {
                    if (str[j] != ",") {
                        output.push(str[j]);
                        if (i % 3 == 0 && j < (len - 1)) {
                            output.push(",");
                        }
                        i++;
                    }
                }
                formatted = output.reverse().join("");
                return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
            };

            function data_detail(clicked_id) {
                $('#modal_view').modal('show');
                $.ajax({
                    url: "{{ route('get.tagihan.detail') }}",
                    type: 'get',
                    data: {
                        "id": clicked_id
                    },
                    success: function(data) {
                        $("#v_id_panel").text(data.idpel);
                        $("#v_nama_panel").text(data.idpelname);
                        $("#v_tarif").text("Rp. " + format(data.tarif_kwh));
                        $("#v_daya_aw").text(data.daya_awal + " kWh");
                        $("#v_daya_ak").text(data.daya_akhir + " kWh");
                        $("#v_tag").text("Rp. " + format(data.tagihan));
                        $("#v_bulan").text(data.bulan);
                        $("#v_tahun").text(data.tahun);
                    },
                    error: function(request, status, error) {
                        console.log(request.responseText);
                    }
                });
            }

            function data_detail_2(clicked_id) {
                $('#modal_view_2').modal('show');
                $.ajax({
                    url: "{{ route('get.tagihan.detail') }}",
                    type: 'get',
                    data: {
                        "id": clicked_id
                    },
                    success: function(data) {
                        $("#v_id_panel_1").text(data.idpel);
                        $("#v_nama_panel_1").text(data.idpelname);
                        $("#v_tarif_1").text("Rp. " + format(data.tarif_kwh));
                        $("#v_total_daya").text(data.total_daya + " kWh");
                        $("#v_jam_nyala").text(data.jam_nyala + " Jam");
                        $("#v_realisasi_pln").text("Rp. " + format(data.realisasi_pln));
                        $("#v_tag_1").text("Rp. " + format(data.tagihan));
                        if (data.realisasi_pln - data.tagihan < 0) {
                            $("#v_tag_2").text("Rp. -" + format(data.tagihan - data.realisasi_pln));
                        } else {
                            $("#v_tag_2").text("Rp. " + format(data.realisasi_pln - data.tagihan));
                        }
                        $("#v_bulan_1").text(data.bulan);
                        $("#v_tahun_1").text(data.tahun);
                    },
                    error: function(request, status, error) {
                        console.log(request.responseText);
                    }
                });
            }
        </script>
    @endsection
</x-app-layout>
