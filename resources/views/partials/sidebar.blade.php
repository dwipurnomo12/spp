<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <div class="user">
            <div class="avatar-sm float-left mr-2">
                <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        {{ auth()->user()->name }}
                        <span class="user-level">{{ auth()->user()->role->role }}</span>
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
            <li class="nav-item active">
                <a href="/home">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Data Master</h4>
            </li>
            <li class="nav-item">
                <a data-toggle="collapse" href="#base">
                    <i class="fas fa-layer-group"></i>
                    <p>Data master</p>
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

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
