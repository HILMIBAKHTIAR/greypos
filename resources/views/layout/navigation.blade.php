<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}">
            {{-- <span class="app-brand-logo demo">
                <img src="{{ asset('/assets/img/greylogo.png') }}" alt="Brand Logo" class="img-fluid" style="width: 70px;height:70px">
            </span> --}}
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
                GREY COFFEE
            </span>
            {{-- <div>
                <span class="text-brand">GREY POS</span>
              </div> --}}
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">        
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
            <a href="{{route('home')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        {{-- Transaksi --}}
        <li class="menu-item {{ request()->is('transaction') ? 'active' : '' }}">
            <a href="{{route('transaction')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="Transactions">penjualan</div>
            </a>

            @if (Auth::user()->role == 'admin')
            <!-- inventori -->
        <li class="menu-item  {{ request()->is('supplier*')|| request()->is('stock*')? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Layouts">Inventori</div>
            </a>

            <ul class="menu-sub ">
                <li class="menu-item {{ request()->is('supplier*') ? 'active' : '' }}">
                    <a href="{{route('supplier')}}" class="menu-link">
                        <div data-i18n="Without navbar">supplier</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('stock*') ? 'active' : '' }}"">
                    <a href="{{ route('stock') }}" class="menu-link">
                        <div data-i18n="Without navbar">stok</div>
                    </a>
                </li>

            </ul>
        </li>
        @endif

        @if (Auth::user()->role == 'admin')
        {{-- Produk --}}
        <li class="menu-item {{ request()->is('kategori*')|| request()->is('produk*')? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div data-i18n="Account Settings">Produk</div>
            </a>
            <ul class="menu-sub">
                {{-- kategori --}}
                <li class="menu-item {{ request()->is('kategori*') ? 'active' : '' }}">
                    <a href="{{ route('kategori.index') }}" class="menu-link">
                        <div data-i18n="Account">kategori</div>
                    </a>
                </li>
                {{-- produk --}}
                <li class="menu-item {{ request()->is('produk*') ? 'active' : '' }}">
                    <a href="{{ route('produk') }}" class="menu-link">
                        <div data-i18n="Account">produk</div>
                    </a>    
                </li>
            </ul>
        </li>
        @endif


        @if (Auth::user()->role == 'admin')
        {{-- Laporan --}}
        <li class="menu-item {{ request()->is('report*')|| request()->is('outflow*')|| request()->is('cetakoutflowview*')? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-line-chart-down"></i>
                <div data-i18n="Misc">Laporan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('report') ? 'active' : '' }}">
                    <a href="{{ route('report') }}" class="menu-link">
                        <div data-i18n="Error">Transaksi Masuk</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('outflow') ? 'active' : '' }}">
                    <a href="{{ route('outflow') }}" class="menu-link">
                        <div data-i18n="Under Maintenance">Transaksi keluar</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ request()->is('cetakoutflowview') ? 'active' : '' }}">
                    <a href="{{ route('outflowcetakview') }}" class="menu-link">
                        <div data-i18n="Under Maintenance">cetak laporan</div>
                    </a>
                </li> --}}
            </ul>
        </li>
        @endif

        @if (Auth::user()->role == 'admin')
        {{-- User --}}
        {{-- user --}}
        <li class="menu-item {{ request()->is('user') ? 'active' : '' }}">
            <a href="{{route('user')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">User</div>
            </a>
        </li>
        {{-- <li class="menu-item {{ request()->is('user*')|| request()->is('acces*')? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Account Settings">User</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('user*') ? 'active' : '' }}">
                    <a href="{{ route('user') }}" class="menu-link">
                        <div data-i18n="Account">User</div>
                    </a>
                </li>
            </ul>
        </li> --}}
        @endif

        

</aside>
