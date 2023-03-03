 <!-- Start:: main body header -->
 <div class="body-header sticky-md-top">
     <div class="container-fluid">
         <div class="d-flex justify-content-between">
             <!-- Header:: Brand icon -->
             <a class="navbar-brand d-flex align-items-center color-900" href="/">
                 <svg width="48" height="36" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <rect class="fill-secondary" x="1.5" y="4.5" width="27" height="27" rx="13.5" />
                     <rect class="fill-primary" x="13.5" y="1.5" width="33" height="33" rx="16.5" stroke="white" stroke-width="3" />
                 </svg>
                 <span class="h4 mb-0 fw-bold ps-2">Dashboard PED</span>
             </a>
             <!-- Header:: Menu and Mega menu link -->
             <div class="menu-link flex-fill">
                 <!-- Start:: dashboard link -->
                 <div class="menu-apps">
                     <a href="{{ url('/dashboard') }}" class="btn btn-link">
                         <svg class="mx-1" xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                             <path class="fill-secondary" d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"></path>
                             <path class="fill-muted" fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"></path>
                         </svg>
                         <span>Dashboard</span>
                     </a>
                 </div>


                 <!-- Start:: Paket link -->
                 <div class="dropdown menu-apps">
                     <a href="#" class="btn btn-link dropdown-toggle after-none " data-bs-toggle="dropdown" aria-expanded="true">
                         <svg class="mx-1" xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                             <path class="fill-secondary" d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"></path>
                             <path class="fill-muted" d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"></path>
                             <path class="fill-muted" d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"></path>
                         </svg>
                         <span>My Project</span>
                     </a>
                     <div class="dropdown-menu p-2 shadow  bg-body" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 34px);" data-popper-placement="bottom-start">
                         <ul class="list-unstyled mb-0 animation_delay">
                             <li>
                                 <a href="#" class="d-flex align-items-center py-2 rounded">
                                     <div class="avatar rounded no-thumbnail bg-light">
                                         <i class="fa fa-tasks"></i>
                                     </div>
                                     <div class="flex-fill ms-3 text-truncate">
                                         <h6 class="mb-0">All Project</h6>
                                        
                                     </div>
                                 </a>
                             </li>
                             <li>
                                 <a href="#" class="d-flex align-items-center py-2 rounded">
                                     <div class="avatar rounded no-thumbnail bg-light">
                                          <i class="fa fa-rocket"></i>
                                     </div>
                                     <div class="flex-fill ms-3 text-truncate">
                                         <h6 class="mb-0">Project Berjalan</h6>
                                        
                                     </div>
                                 </a>
                             </li>
                             <li>
                                 <a href="#" class="d-flex align-items-center py-2 rounded">
                                     <div class="avatar rounded no-thumbnail bg-light">
                                         <i class="fa fa-calendar"></i>
                                     </div>
                                     <div class="flex-fill ms-3 text-truncate">
                                         <h6 class="mb-0">Kalender Plan</h6>
                                        
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </div>

                 <!-- Start:: Laporan link -->
                 {{-- <div class="dropdown menu-apps">
                     <a href="#" class="btn btn-link dropdown-toggle after-none " data-bs-toggle="dropdown" aria-expanded="true">
                        <svg class="mx-1" xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                             <path class="fill-secondary" d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"></path>
                             <path class="fill-muted" d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"></path>
                             <path class="fill-muted" d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"></path>
                         </svg>
                         <span>Modul Laporan</span>
                     </a>
                     <div class="dropdown-menu p-2 shadow  bg-body" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 34px);" data-popper-placement="bottom-start">
                         <ul class="mb-0 animation_delay list-unstyled">
                             <li><a class="dropdown-item" href="index.html">Laporan Harian</a></li>
                             <li><a class="dropdown-item" href="#">Daftar Paket</a></li>
                         </ul>
                     </div>
                 </div> --}}


             </div>
             <!-- Header:: icon and user profile -->
             <ul class="nav navbar-right d-flex align-items-center mb-0 list-unstyled">
                 <!-- start: quick light dark -->
                 <li>
                     <a class="nav-link quick-light-dark" href="#">
                         <i class="bi bi-moon"></i>
                     </a>
                 </li>
                 <!-- start: notifications dropdown-menu -->
                 <li class="d-none d-sm-inline-block">
                     <div class="dropdown morphing scale-left">
                         <a class="nav-link dropdown-toggle after-none" href="#" role="button" data-bs-toggle="dropdown">
                             <i class="bi bi-bell-fill"></i>
                         </a>
                         <div class="dropdown-menu shadow-lg border-0 p-0 notifications" id="notifications">
                             <div class="card">
                                 <div class="card-header">
                                     <h6 class="card-title mb-0">Notifications Center</h6>
                                     <span class="badge bg-primary">14</span>
                                 </div>
                                 <ul class="list-unstyled list-group list-group-custom mb-0 custom_scroll" style="height: 320px;">
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-thumbs-o-up fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">7 New Feedback</a> <small class="float-end text-muted">Today</small></h6>
                                             <small>It will give a smart finishing to your site</small>
                                         </div>
                                     </li>
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-user fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">New User</a> <small class="float-end text-muted">10:45</small></h6>
                                             <small>I feel great! Thanks team</small>
                                         </div>
                                     </li>
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-question-circle fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">Server Warning</a> <small class="float-end text-muted">10:50</small></h6>
                                             <small>Your connection is not private</small>
                                         </div>
                                     </li>
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-check fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">Issue Fixed</a> <small class="float-end text-muted">11:05</small></h6>
                                             <small>WE have fix all Design bug with Responsive</small>
                                         </div>
                                     </li>
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-shopping-basket fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">7 New Orders</a> <small class="float-end text-muted">11:35</small></h6>
                                             <small>You received a new oder from Tina.</small>
                                         </div>
                                     </li>
                                 </ul>
                                 <div class="card-body py-2">
                                     <a href="#" class="btn btn-link">View all notifications</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </li>
                 <li>
                     <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2">
                         <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#" role="button" data-bs-toggle="dropdown">
                             <img class="avatar lg img-thumbnail rounded-circle shadow" src="{{ getAvatar(activeGuard(), auth(activeGuard())->user()->id) }}" alt="">
                         </a>
                         <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                             <div class="card w240 overflow-hidden">
                                 <div class="card-body">
                                     <h6 class="card-title mb-0">{{ getUser()->name }}</h6>
                                     <p class="text-muted">{{ Auth::guard(activeGuard())->user()->email }}</p>
                                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn bg-danger text-light text-uppercase w-100">Sign out</a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                         @csrf
                                     </form>
                                 </div>
                                 <div class="list-group m-2">
                                     <a class="list-group-item list-group-item-action border-0" href="{{ route('user.index') }}"><i class="w30 fa fa-user"></i>Profile & account</a>

                                 </div>
                             </div>
                         </div>
                     </div>
             </ul>
         </div>
     </div>
 </div>
