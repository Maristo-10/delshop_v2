<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/dashboard">
                <img src="{{ asset('pembeli/images/logo2.png') }}" alt="" class="w-75 h-90">
            </a>
        </div>
        <hr class="w-100" style="border: solid 1px;border-color:gainsboro">
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="/dashboard" aria-expanded="false" class="nav-link">
                    <i class="fa-solid fa-house"></i>
                    <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#produk" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span class="ml-3 item-text">Manajemen Produk</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="produk">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/kelola/produk"><span class="ml-1 item-text">Kelola
                                Produk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/kelola/kategori-produk"><span class="ml-1 item-text">Kelola Kategori
                                Produk</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/detail/penjualan/produk"><span class="ml-1 item-text">Detail Penjualan
                                Produk</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#pesanan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="ml-3 item-text">Manajemen Pesanan</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="pesanan">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/konfirmasi/pesanan"><span class="ml-1 item-text">Konfirmasi Pesanan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/pesanan/diproses"><span class="ml-1 item-text">Pesanan Diproses</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/pesanan/selesai"><span class="ml-1 item-text">Pesanan Selesai</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/pesanan/dibatalkan"><span class="ml-1 item-text">Pesanan Dibatalkan</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#metodepembayaran" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fa-solid fa-money-check"></i>
                    <span class="ml-3 item-text">Manajemen Pembayaran</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="metodepembayaran">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/metode/pembayaran"><span class="ml-1 item-text">Metode Pembayaran</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/kategori/pembayaran"><span class="ml-1 item-text">Kategori Pembayaran</span></a>
                    </li>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#laporan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span class="ml-3 item-text">Manajemen Laporan</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="laporan">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/laporan/penjualan"><span class="ml-1 item-text">Laporan Penjualan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/laporan/labarugi"><span class="ml-1 item-text">Laporan Laba Rugi</span></a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#pengguna" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fa-solid fa-users-gear"></i>
                    <span class="ml-3 item-text">Manajemen Pengguna</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="pengguna">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="/kelola/pengguna"><span class="ml-1 item-text">Kelola
                                Pengguna</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="/kelola/corousel" aria-expanded="false" class="nav-link">
                    <i class="fa-solid fa-images"></i>
                    <span class="ml-3 item-text">Kelola Corousel</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
