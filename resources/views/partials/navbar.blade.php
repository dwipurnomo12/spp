 <div class="container-fluid">
     <div class="collapse" id="search-nav">
         <form class="navbar-left navbar-form nav-search mr-md-3">
             <div class="input-group">

             </div>
         </form>
     </div>
     <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
         <li class="nav-item toggle-nav-search hidden-caret">
             <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false"
                 aria-controls="search-nav">
                 <i class="fa fa-search"></i>
             </a>
         </li>

         <li class="nav-item dropdown hidden-caret">
             <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                 <div class="avatar-sm">
                     <img src="/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                 </div>
             </a>
             <ul class="dropdown-menu dropdown-user animated fadeIn">
                 <div class="dropdown-user-scroll scrollbar-outer">

                     <li>
                         <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                Swal.fire({
                                    title: 'Konfirmasi Keluar',
                                    text: 'Apakah Anda yakin ingin keluar?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Keluar!'
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                      document.getElementById('logout-form').submit();
                                    }
                                  });">
                             <i class="fas fa-sign-out-alt"></i> {{ __('Keluar') }}
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                         </a>
                     </li>
                 </div>
             </ul>
         </li>
     </ul>
 </div>
