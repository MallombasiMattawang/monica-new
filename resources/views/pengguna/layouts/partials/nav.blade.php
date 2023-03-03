   <div class="body-header sticky-md-top">
       <div class="container-fluid">
           <div class="justify-content-between">
               <div class="row">
                   <div class="col-2">
                       <a class="navbar-brand d-flex align-items-center color-900" href="#">
                           <img src="{{ asset('img/logo-kab.png') }}" width="20px;" alt="">
                           <span class=" mb-0 fw-bold ps-2">Smart<span class="text-primary">School</span> </span>
                       </a>
                   </div>
                   <div class="col-10">
                       <div class="menu-link navbar-right" style="float: right;">

                         <div class="dropdown menu-apps active">
                       <a class="btn btn-link" href="{{ route('dashboard') }}">
                           <span class="iconify text-primary mr-5" data-width="23" data-icon="line-md:home-simple-twotone"></span>
                           <span>Dashboard</span>
                       </a>
                   </div>


                   <div class="dropdown menu-apps ">
                       <a href="#" class="btn btn-link dropdown-toggle after-none" data-bs-toggle="dropdown">
                            <span class="iconify-inline text-primary  mr-5" data-width="23" data-icon="line-md:valign-baseline-twotone"></span>

                           <span>Data Sekolah</span>
                       </a>
                       <div class="dropdown-menu mega-dropdown p-4 shadow-lg">
                           <div class="row g-3">
                               <div class="col-lg-12">
                                   <ul class="list-unstyled mb-0 animation_delay">
                                       <li>
                                           <a href="{{ route('sekolah.index') }}"
                                               class="d-flex align-items-center py-2 rounded">
                                               <div class="avatar rounded no-thumbnail bg-light">
                                                   <span class="iconify-inline text-primary" data-width="22"
                                                       data-icon="icon-park-twotone:school"></span>
                                               </div>
                                               <div class="flex-fill ms-3 text-truncate">
                                                   <h6 class="mb-0">Sekolah</h6>
                                                   <small class="text-muted">Daftar Sekolah Negeri dan Swasta</small>
                                               </div>
                                           </a>
                                       </li>
                                       <li>
                                           <a href="{{ route('gtk.index','pendidik') }}" class="d-flex align-items-center py-2 rounded">
                                               <div class="avatar rounded no-thumbnail bg-light">
                                                   <span class="iconify-inline" data-width="20"
                                                       data-icon="icon-park-twotone:user-business"></span>
                                               </div>
                                               <div class="flex-fill ms-3 text-truncate">
                                                   <h6 class="mb-0">Guru</h6>
                                                   <small class="text-muted">Data Guru </small>
                                               </div>
                                           </a>
                                       </li>

                                       <li>
                                           <a href="{{ route('gtk.index','tendik') }}" class="d-flex align-items-center py-2 rounded">
                                               <div class="avatar rounded no-thumbnail bg-light">
                                                   <span class="iconify-inline" data-width="20"
                                                       data-icon="icon-park-twotone:user-positioning"></span>
                                               </div>
                                               <div class="flex-fill ms-3 text-truncate">
                                                   <h6 class="mb-0">Tendik</h6>
                                                   <small class="text-muted">Data Tendik</small>
                                               </div>
                                           </a>
                                       </li>
                                       <li>
                                           <a href="{{ route('siswa.index') }}" class="d-flex align-items-center py-2 rounded">
                                               <div class="avatar rounded no-thumbnail bg-light">
                                                   <span class="iconify-inline" data-width="20"
                                                       data-icon="icon-park-twotone:user-positioning"></span>
                                               </div>
                                               <div class="flex-fill ms-3 text-truncate">
                                                   <h6 class="mb-0">Siswa</h6>
                                                   <small class="text-muted">Data Siswa</small>
                                               </div>
                                           </a>
                                       </li>

                                   </ul>
                               </div>

                           </div>
                       </div>
                   </div>

                   <div class="dropdown menu-apps ">
                       <a href="#" class="btn btn-link dropdown-toggle after-none" data-bs-toggle="dropdown">
                           <span class="iconify text-primary mr-5" data-width="23"
                               data-icon="line-md:clipboard-check-twotone"></span>
                           <span>Presensi</span>
                       </a>
                       <div class="dropdown-menu mega-dropdown p-4 shadow-lg">
                           <div class="row g-3">
                               <div class="col-lg-12">
                                   <ul class="list-unstyled mb-0 animation_delay">
                                       <li>
                                           <a href="{{ route('presensi') }}" class="d-flex align-items-center py-2 rounded">
                                               <div class="avatar rounded no-thumbnail bg-light">
                                                   <span class="iconify-inline text-primary" data-width="22"
                                                       data-icon="iconoir:fingerprint-scan"></span>
                                               </div>
                                               <div class="flex-fill ms-3 text-truncate">
                                                   <h6 class="mb-0">Guru</h6>
                                                   <small class="text-muted">Presensi Guru</small>
                                               </div>
                                           </a>
                                       </li>
                                       <li>
                                           <a href="{{ route('presensi') }}" class="d-flex align-items-center py-2 rounded">
                                               <div class="avatar rounded no-thumbnail bg-light">
                                                   <span class="iconify-inline text-primary" data-width="22" data-icon="iconoir:fingerprint-scan"></span>
                                               </div>
                                               <div class="flex-fill ms-3 text-truncate">
                                                   <h6 class="mb-0">Siswa</h6>
                                                   <small class="text-muted">Presensi Siswa</small>
                                               </div>
                                           </a>
                                       </li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="dropdown menu-apps">
                       <a class="btn btn-link" href="{{ route('administrasi') }}">
                           <span class="iconify text-primary mr-5" data-width="23" data-icon="line-md:text-box-multiple-twotone"></span>
                           <span>Administrasi</span>
                       </a>
                   </div>

                   <div class="dropdown menu-apps">
                       <a class="btn btn-link" href="{{ route('kuis') }}">
                           <span class="iconify text-primary mr-5" data-width="23" data-icon="line-md:lightbulb-twotone"></span>
                           <span>Kuis</span>
                       </a>
                   </div>


                    <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2" style="margin-left:15px !important;">
                           <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#"
                               role="button" data-bs-toggle="dropdown">
                               <img class="avatar lg img-thumbnail rounded-circle shadow"
                                   src="{{ asset('img/profile_av.png') }}" alt="">
                           </a>
                           <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                               <div class="card w240 overflow-hidden">
                                   <div class="card-body">
                                       {{-- <h6 class="card-title mb-0"> {{ Auth::user()->name }} </h6> --}}
                                       <h6 class="card-title mb-0"> {{ Auth::guard(activeGuard())->user()->nama_sekolah }} </h6>
                                       <p class="text-muted"><a href="" class="__cf_email__">[{{ activeGuard() }}]</a> </p>


                                       <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                           class="btn bg-danger text-light text-uppercase w-100">Sign out</a>

                                       <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                           style="display: none;">
                                           @csrf
                                       </form>


                                   </div>
                                   <div class="list-group m-2">
                                       <a class="list-group-item list-group-item-action border-0"
                                           href="page-profile.html"><i class="w30 fa fa-user"></i>Profile &
                                           account</a>
                                       <a class="list-group-item list-group-item-action border-0"
                                           href="account-settings.html"><i class="w30 fa fa-gear"></i>Settings</a>
                                       <a class="list-group-item list-group-item-action border-0"
                                           href="page-support-ticket.html"><i class="w30 fa fa-tag"></i>Support
                                           Ticket</a>
                                       <a class="list-group-item list-group-item-action border-0"
                                           href="page-teamsboard.html"><i class="w30 fa fa-users"></i>Manage
                                           team</a>
                                       <a class="list-group-item list-group-item-action border-0" href="#"><i
                                               class="w30 fa fa-calendar"></i>My Events</a>
                                       <a class="list-group-item list-group-item-action border-0"
                                           href="account-billing.html"><i
                                               class="w30 fa fa-credit-card"></i>Billing</a>
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
