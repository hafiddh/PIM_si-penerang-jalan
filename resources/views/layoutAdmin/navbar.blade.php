<li><a href="{{ route('dashboard') }}" class="ai-icon" aria-expanded="false">
        <i class="flaticon-025-dashboard"></i>
        <span class="nav-text">Dashboard</span>
    </a>
</li>

<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-022-copy"></i>
        <span class="nav-text">Data Set</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ route('location') }}">Lokasi</a></li>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Komponen</a>
            <ul aria-expanded="false">
                <li><a href="{{ route('show.merk') }}">Merk</a></li>
                <li><a href="{{ route('show.type') }}">Type</a></li>
                <li><a href="{{ route('show.tarif') }}">Tarif KWH</a></li>
                <li><a href="{{ route('show.idpel') }}">IDPEL</a></li>
            </ul>
        </li>
    </ul>
</li>
<li><a href="{{ route('show.light') }}" class="ai-icon" aria-expanded="false">
        <i class="flaticon-025-dashboard"></i>
        <span class="nav-text">Lampu Jalan</span>
    </a>
</li>
<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-022-copy"></i>
        <span class="nav-text">Tagihan</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ route('index.tagihan') }}">Tagihan</a></li>
    </ul>
</li>
<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-041-graph"></i>
        <span class="nav-text">Detail Data</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ route('index.camat') }}">Kecamatan</a></li>
        <li><a href="{{ route('index.desa') }}"> Desa</a></li>
        <li><a href="{{ route('index.panel') }}"> Panel</a></li>
    </ul>
</li>
<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-043-menu"></i>
        <span class="nav-text">Detail Tagihan</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ route('index.tagihan.bulan') }}">Bulan</a></li>
        <li><a href="{{ route('index.tagihan.panel') }}">Panel</a></li>
    </ul>
</li>
