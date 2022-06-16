<!-- Side Nav START -->
<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item">
                <a class="" href="{{route('home')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>

                </a>
            </li>

            @permission('1')
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Master Data</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('unit.index')}}">Unit</a>
                    </li>
                    <li>
                        <a href="{{route('category.index')}}">Kategori</a>
                    </li>
                    <li>
                        <a href="{{route('ongkir.index')}}">Ongkir</a>
                    </li>
                    <li>
                        <a href="{{route('bank.index')}}">Bank</a>
                    </li>
                </ul>
            </li>
            @endpermission



            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-barcode"></i>
                    </span>
                    <span class="title">Produk</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('product.index')}}">List Produk</a>
                    </li>
                    <li>
                        <a href="{{route('product.create')}}">Tambah Product</a>
                    </li>
                    <li>
                        <a href="{{route('stock.index')}}">Stock</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-shopping-cart"></i>
                    </span>
                    <span class="title">Transaksi</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('sales.index')}}">Penjualan</a>
                    </li>
                    <li>
                        <a href="{{route('sales.index')}}">Report</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-file"></i>
                    </span>
                    <span class="title">Report</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('sales.report')}}">Penjualan</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title">Settings</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('user.index')}}">User</a>
                    </li>
                    <li>
                        <a href="{{route('customer.index')}}">Customer</a>
                    </li>
                    {{-- <li>
                        <a href="{{route('customer.index')}}">Customer</a>
                    </li> --}}
                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- Side Nav END -->
