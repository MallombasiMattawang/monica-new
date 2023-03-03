 <!-- Start:: main body header -->
 <div class="body-header sticky-md-top">
     <div class="container-fluid">
         <div class="d-flex justify-content-between">
             <!-- Header:: Brand icon -->
             <a class="navbar-brand d-flex align-items-center color-900" href="index.html">
                 <svg width="48" height="36" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <rect class="fill-secondary" x="1.5" y="4.5" width="27" height="27"
                         rx="13.5" />
                     <rect class="fill-primary" x="13.5" y="1.5" width="33" height="33"
                         rx="16.5" stroke="white" stroke-width="3" />
                 </svg>
                 <span class="h4 mb-0 fw-bold ps-2">I-ManPro</span>
             </a>
             <!-- Header:: Menu and Mega menu link -->
             <div class="menu-link flex-fill">
                 <!-- Start:: dashboard link -->
                 <div class="menu-apps">
                     <a href="{{ url('/dashboard') }}" class="btn btn-link">
                         <i class="fa fa-dashboard"></i> &nbsp;
                         <span>Dashboard</span>
                     </a>
                 </div>
                 <!-- Start:: dashboard link -->
                 <div class="dropdown menu-apps">
                     <a href="#" class="btn btn-link dropdown-toggle after-none " data-bs-toggle="dropdown"
                         aria-expanded="true">
                         <i class="fa fa-dropbox"></i> &nbsp;
                         <span>Modul Paket</span>
                     </a>
                     <div class="dropdown-menu p-2 shadow  bg-body"
                         style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 34px);"
                         data-popper-placement="bottom-start">
                         <ul class="mb-0 animation_delay list-unstyled">
                             <li><a class="dropdown-item" href="index.html">Avio Analytics</a></li>
                             <li><a class="dropdown-item" href="#">HR &amp; Project</a></li>
                             <li><a class="dropdown-item" href="#">Hospital Management</a></li>
                             <li><a class="dropdown-item" href="#">eCommerce</a></li>
                             <li><a class="dropdown-item" href="#">Event data</a></li>
                             <li><a class="dropdown-item" href="#">School &amp; University</a></li>
                         </ul>
                     </div>
                 </div>


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
                         <a class="nav-link dropdown-toggle after-none" href="#" role="button"
                             data-bs-toggle="dropdown">
                             <i class="bi bi-bell-fill"></i>
                         </a>
                         <div class="dropdown-menu shadow-lg border-0 p-0 notifications" id="notifications">
                             <div class="card">
                                 <div class="card-header">
                                     <h6 class="card-title mb-0">Notifications Center</h6>
                                     <span class="badge bg-primary">14</span>
                                 </div>
                                 <ul class="list-unstyled list-group list-group-custom mb-0 custom_scroll"
                                     style="height: 320px;">
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-thumbs-o-up fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">7 New Feedback</a> <small
                                                     class="float-end text-muted">Today</small></h6>
                                             <small>It will give a smart finishing to your site</small>
                                         </div>
                                     </li>
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-user fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">New User</a> <small
                                                     class="float-end text-muted">10:45</small></h6>
                                             <small>I feel great! Thanks team</small>
                                         </div>
                                     </li>
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-question-circle fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">Server Warning</a> <small
                                                     class="float-end text-muted">10:50</small></h6>
                                             <small>Your connection is not private</small>
                                         </div>
                                     </li>
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-check fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">Issue Fixed</a> <small
                                                     class="float-end text-muted">11:05</small></h6>
                                             <small>WE have fix all Design bug with Responsive</small>
                                         </div>
                                     </li>
                                     <li class="list-group-item d-flex border-end-0 border-start-0">
                                         <div class="avatar"><i class="fa fa-shopping-basket fa-lg"></i></div>
                                         <div class="flex-grow-1 ms-2">
                                             <h6 class="mb-0 fw-light"><a href="#">7 New Orders</a> <small
                                                     class="float-end text-muted">11:35</small></h6>
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
                         <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#"
                             role="button" data-bs-toggle="dropdown">
                             <img class="avatar lg img-thumbnail rounded-circle shadow"
                                 src="{{ getAvatar(activeGuard(), auth(activeGuard())->user()->id) }}" alt="">
                         </a>
                         <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                             <div class="card w240 overflow-hidden">
                                 <div class="card-body">
                                     <h6 class="card-title mb-0">{{ Auth::guard(activeGuard())->user()->name }}</h6>
                                     <p class="text-muted">{{ Auth::guard(activeGuard())->user()->email }}</p>
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
                                         href="#"><i class="w30 fa fa-user"></i>Profile & account</a>
                                    
                                 </div>
                             </div>
                         </div>
                     </div>
             </ul>
         </div>
     </div>
 </div>
