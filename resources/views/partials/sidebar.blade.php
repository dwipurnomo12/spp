<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <div class="user">
            <div class="avatar-sm float-left mr-2">
                <img src="/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        @if (auth()->user()->admin)
                            {{ auth()->user()->admin->name }}
                            <span class="user-level">{{ auth()->user()->admin->username }}</span>
                        @else
                            {{ auth()->user()->siswa->nm_siswa }}
                            <span class="user-level">{{ auth()->user()->siswa->nis }}</span>
                        @endif
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">Profil</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav nav-primary">
            <li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
                <a href="/home">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if (auth()->user()->isAdmin())
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Data Master</h4>
                </li>
                <li class="nav-item {{ Request::is('siswa*', 'kelas*', 'tahun-ajaran*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-users"></i>
                        <p>Data Siswa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/siswa">
                                    <span class="sub-item">Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="/kelas">
                                    <span class="sub-item">Kelas</span>
                                </a>
                            </li>
                            <li>
                                <a href="/tahun-ajaran">
                                    <span class="sub-item">Tahun Ajaran</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ Request::is('biaya*') ? 'active' : '' }}">
                    <a href="/biaya">
                        <i class="fas fa-regular fa-money-bill-1"></i>
                        <p>Biaya</p>
                    </a>
                </li>


                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Pembaharuan Data</h4>
                </li>
                <li class="nav-item {{ Request::is('kenaikan-kelas*', 'kelulusan*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#pembaharuan">
                        <i class="fas fa-regular fa-pen-to-square"></i>
                        <p>Data Siswa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="pembaharuan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/kenaikan-kelas">
                                    <span class="sub-item">Kenaikan Kelas</span>
                                </a>
                            </li>
                            <li>
                                <a href="/kelulusan">
                                    <span class="sub-item">Kelulusan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Saldo</h4>
                </li>
                <li class="nav-item {{ Request::is('saldo*') ? 'active' : '' }}">
                    <a href="/saldo">
                        <i class="fa fa-solid fa-money-bill-trend-up"></i>
                        <p>Saldo Saat Ini</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('pengeluaran*') ? 'active' : '' }}">
                    <a href="/pengeluaran">
                        <i class="fa fa-solid fa-arrow-right-from-bracket"></i>
                        <p>Pengeluaran</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Tagihan</h4>
                </li>
                <li class="nav-item {{ Request::is('tagihan*') ? 'active' : '' }}">
                    <a href="/tagihan">
                        <i class="fa fa-solid fa-coins"></i>
                        <p>Data Tagihan</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('tambah-tagihan*') ? 'active' : '' }}">
                    <a href="/tambah-tagihan">
                        <i class="fa fa-solid fa-money-bill-wave"></i>
                        <p>Tambah Tagihan</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Tabungan</h4>
                </li>
                <li
                    class="nav-item {{ Request::is('tabungan-siswa*', 'setor-tunai*', 'penarikan*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#tabungann">
                        <i class="fa fa-solid fa-wallet"></i>
                        <p>Tabungan Siswa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tabungann">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/tabungan-siswa">
                                    <span class="sub-item">Tabungan Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="/setor-tunai">
                                    <span class="sub-item">Setor Tunai</span>
                                </a>
                            </li>
                            <li>
                                <a href="/penarikan">
                                    <span class="sub-item">Penarikan / Pencairan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Pembayaran</h4>
                </li>
                <li class="nav-item {{ Request::is('transaksi*') ? 'active' : '' }}">
                    <a href="/transaksi">
                        <i class="fa fa-solid fa-money-bill-transfer"></i>
                        <p>Transaksi</p>
                    </a>
                </li>
            @else
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Pembayaran</h4>
                </li>
                <li class="nav-item {{ Request::is('cek-tagihan*') ? 'active' : '' }}">
                    <a href="/cek-tagihan">
                        <i class="fa fa-solid fa-coins"></i>
                        <p>Cek Tagihan</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('riwayat-pembayaran*') ? 'active' : '' }}">
                    <a href="/riwayat-pembayaran">
                        <i class="fa fa-solid fa-coins"></i>
                        <p>Riwayat Pembayaran</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Tabungan</h4>
                </li>
                <li class="nav-item {{ Request::is('tabungan*') ? 'active' : '' }}">
                    <a href="/tabungan">
                        <i class="fa fa-solid fa-wallet"></i>
                        <p>Saldo Tabungan</p>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
