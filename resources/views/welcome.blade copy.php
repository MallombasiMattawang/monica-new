<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="I-ManPro - Aplikasi Manajemen Paket Proyek Pemerintahan">
    <meta name="keyword" content="I-ManPro - Aplikasi Manajemen Paket Proyek Pemerintahan">
    <link rel="icon" href="{{ asset('img/logo-kab.png') }}" type="image/x-icon">
    <title>I-ManPro - Aplikasi Manajemen Paket Proyek Pemerintahan</title>
    <link rel="stylesheet" href="{{ asset('css/avio-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>

</head>

<body data-avio="theme-indigo">
    <div class="avio">
        <!-- Start:: main body header -->
        <div class="body-header sticky-md-top">
          <div class="container-fluid">
            <div class="d-flex justify-content-between">
              <!-- Header:: Brand icon -->
              <a class="navbar-brand d-flex align-items-center color-900" href="index.html">
                <svg width="48" height="36" viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect class="fill-secondary" x="1.5" y="4.5" width="27" height="27" rx="13.5" />
                  <rect class="fill-primary" x="13.5" y="1.5" width="33" height="33" rx="16.5" stroke="white" stroke-width="3" />
                </svg>
                <span class="h4 mb-0 fw-bold ps-2">I-ManPro</span>
              </a>
              <!-- Header:: Menu and Mega menu link -->
              <div class="menu-link flex-fill">
                <!-- Start:: dashboard link -->
                <div class="dropdown menu-apps active">
                  <a href="#" class="btn btn-link dropdown-toggle after-none" data-bs-toggle="dropdown">
                    <svg class="mx-1" xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                      <path class="fill-secondary" d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"></path>
                      <path class="fill-muted" fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"></path>
                    </svg>
                    <span>Dashboard</span>
                  </a>
                  <div class="dropdown-menu p-2 shadow">
                    <ul class="mb-0 animation_delay list-unstyled">
                      <li><a class="dropdown-item active" href="index.html">Avio Analytics</a></li>
                      <li><a class="dropdown-item" href="#">HR & Project</a></li>
                      <li><a class="dropdown-item" href="#">Hospital Management</a></li>
                      <li><a class="dropdown-item" href="#">eCommerce</a></li>
                      <li><a class="dropdown-item" href="#">Event data</a></li>
                      <li><a class="dropdown-item" href="#">School & University</a></li>
                    </ul>
                  </div>
                </div>
                <!-- Start:: application link -->
                <div class="dropdown menu-apps">
                  <a href="#" class="btn btn-link dropdown-toggle after-none" data-bs-toggle="dropdown">
                    <svg class="mx-1" xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                      <path class="fill-muted" d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"></path>
                      <path class="fill-secondary" d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                    </svg>
                    <span>Apps</span>
                  </a>
                  <div class="dropdown-menu mega-dropdown p-4 shadow">
                    <div class="row g-3">
                      <div class="col-lg-7">
                        <ul class="list-unstyled mb-0 animation_delay">
                          <li>
                            <a href="./app-calendar.html" class="d-flex align-items-center py-2 rounded">
                              <div class="avatar rounded no-thumbnail bg-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                                  <path class="fill-secondary" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"></path>
                                  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
                                  <path class="fill-secondary" d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"></path>
                                </svg>
                              </div>
                              <div class="flex-fill ms-3 text-truncate">
                                <h6 class="mb-0">Calendar</h6>
                                <small class="text-muted">Manage your events beautifully.</small>
                              </div>
                            </a>
                          </li>
                          <li>
                            <a href="./app-email.html" class="d-flex align-items-center py-2 rounded">
                              <div class="avatar rounded no-thumbnail bg-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                                  <path class="fill-secondary" d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
                                </svg>
                              </div>
                              <div class="flex-fill ms-3 text-truncate">
                                <h6 class="mb-0">Inbox App</h6>
                                <small class="text-muted">An app to check all your emails.</small>
                              </div>
                            </a>
                          </li>
                          <li>
                            <a href="./app-chat.html" class="d-flex align-items-center py-2 rounded">
                              <div class="avatar rounded no-thumbnail bg-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
                                  <path class="fill-secondary" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"></path>
                                </svg>
                              </div>
                              <div class="flex-fill ms-3 text-truncate">
                                <h6 class="mb-0">Chat App</h6>
                                <small class="text-muted">Chat with individuals and the groups</small>
                              </div>
                            </a>
                          </li>
                          <li>
                            <a href="./app-campaigns.html" class="d-flex align-items-center py-2 rounded">
                              <div class="avatar rounded no-thumbnail bg-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"></path>
                                  <path class="fill-secondary" d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                                </svg>
                              </div>
                              <div class="flex-fill ms-3 text-truncate">
                                <h6 class="mb-0">Campaigns</h6>
                                <small class="text-muted">This is the best in class app for the campaigns.</small>
                              </div>
                            </a>
                          </li>
                          <li>
                            <a href="./app-social.html" class="d-flex align-items-center py-2 rounded">
                              <div class="avatar rounded no-thumbnail bg-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z" />
                                  <path class="fill-secondary" d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-4-4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                              </div>
                              <div class="flex-fill ms-3 text-truncate">
                                <h6 class="mb-0">Social App</h6>
                                <small class="text-muted">Manage all the social media campaigns.</small>
                              </div>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="col-lg-5">
                        <div class="bg-body px-4 py-3 rounded-4 border">
                          <ul class="list-unstyled lh-lg mb-0 animation_delay">
                            <li>
                              <h6 class="fw-bold text-muted">More Application</h6>
                            </li>
                            <li><a href="./app-project.html"><i class="fa fa-angle-right me-3"></i>Project</a></li>
                            <li><a href="./app-calendar-tui.html"><i class="fa fa-angle-right me-3"></i>Calendar tui</a></li>
                            <li><a href="./app-file-manager.html"><i class="fa fa-angle-right me-3"></i>File Manager</a></li>
                            <li><a href="./app-todo.html"><i class="fa fa-angle-right me-3"></i>Todo</a></li>
                            <li><a href="./app-contacts.html"><i class="fa fa-angle-right me-3"></i>Contacts</a></li>
                            <li><a href="./app-tasks.html"><i class="fa fa-angle-right me-3"></i>Tasks</a></li>
                            <li><a href="./app-jkanban.html"><i class="fa fa-angle-right me-3"></i>jKanban</a></li>
                            <li><a href="./app-blog.html"><i class="fa fa-angle-right me-3"></i>Blog</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Start:: extra pages link -->
                <div class="dropdown menu-pages">
                  <a href="#" class="btn btn-link dropdown-toggle after-none" data-bs-toggle="dropdown">
                    <svg class="mx-1" xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                      <path class="fill-secondary" fill-rule="evenodd" d="M8.646 5.646a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L10.293 8 8.646 6.354a.5.5 0 0 1 0-.708zm-1.292 0a.5.5 0 0 0-.708 0l-2 2a.5.5 0 0 0 0 .708l2 2a.5.5 0 0 0 .708-.708L5.707 8l1.647-1.646a.5.5 0 0 0 0-.708z"></path>
                      <path class="fill-muted" d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"></path>
                      <path class="fill-muted" d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"></path>
                    </svg>
                    <span>Pages</span>
                  </a>
                  <ul class="dropdown-menu p-2 shadow animation_delay">
                    <li class="dropdown-submenu">
                      <a href="#" data-bs-toggle="dropdown" class="dropdown-item d-flex dropdown-toggle after-none">
                        <span>Sub Dropdown</span>
                        <svg class="ms-auto" width="18" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <ellipse class="fill-secondary" cx="5.42825" cy="4.59252" rx="2.85696" ry="2.96255" />
                          <path class="fill-primary" fill-rule="evenodd" clip-rule="evenodd" d="M0 4C0 3.88214 0.04515 3.76911 0.125518 3.68577C0.205885 3.60244 0.314887 3.55562 0.428544 3.55562H10.5362L7.83893 0.759566C7.75846 0.676123 7.71325 0.56295 7.71325 0.444943C7.71325 0.326937 7.75846 0.213764 7.83893 0.130321C7.9194 0.0468777 8.02854 2.78032e-09 8.14234 0C8.25614 -2.78032e-09 8.36528 0.0468777 8.44575 0.130321L11.8741 3.68538C11.914 3.72666 11.9457 3.7757 11.9673 3.82968C11.9889 3.88367 12 3.94155 12 4C12 4.05845 11.9889 4.11633 11.9673 4.17032C11.9457 4.2243 11.914 4.27334 11.8741 4.31462L8.44575 7.86968C8.36528 7.95312 8.25614 8 8.14234 8C8.02854 8 7.9194 7.95312 7.83893 7.86968C7.75846 7.78624 7.71325 7.67306 7.71325 7.55506C7.71325 7.43705 7.75846 7.32388 7.83893 7.24043L10.5362 4.44438H0.428544C0.314887 4.44438 0.205885 4.39756 0.125518 4.31423C0.04515 4.23089 0 4.11786 0 4V4Z" />
                        </svg>
                      </a>
                      <ul class="dropdown-menu border-0 p-2 shadow-lg animation_delay">
                        <li><a href="#" class="dropdown-item">Item 1</a></li>
                        <li><a href="#" class="dropdown-item">Item 2</a></li>
                        <li><a href="#" class="dropdown-item">Item 3</a></li>
                      </ul>
                    </li>
                    <li><a class="dropdown-item" href="page-profile.html"><span>My Profile</span></a></li>
                    <li><a class="dropdown-item" href="page-bookmark.html"><span>My Bookmark</span></a></li>
                    <li><a class="dropdown-item" href="page-timeline.html"><span>Timeline</span></a></li>
                    <li><a class="dropdown-item" href="page-imagegallery.html"><span>Image Gallery</span></a></li>
                    <li><a class="dropdown-item" href="page-pricing.html"><span>Pricing List</span></a></li>
                    <li><a class="dropdown-item" href="page-teamsboard.html"><span>Teamsboard</span></a></li>
                    <li><a class="dropdown-item" href="page-support-ticket.html"><span>Support Ticket</span></a></li>
                    <li><a class="dropdown-item" href="page-faqs.html"><span>FAQs</span></a></li>
                    <li><a class="dropdown-item" href="page-search.html"><span>Search page</span></a></li>
                  </ul>
                </div>
                <!-- Start:: document &  resources link-->
                <div class="dropdown menu-resources">
                  <a href="#" class="btn btn-link dropdown-toggle after-none" data-bs-toggle="dropdown">
                    <svg class="mx-1" xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                      <path class="fill-secondary" d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"></path>
                      <path class="fill-muted" d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"></path>
                      <path class="fill-muted" d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"></path>
                    </svg>
                    <span>Resources</span>
                  </a>
                  <div class="dropdown-menu mega-dropdown fullwidth shadow bg-body rounded-0">
                    <div class="container-fluid">
                      <div class="row g-3">
                        <div class="col-xl-7 col-lg-12 col-md-12">
                          <div class="row g-3 row-deck">
                            <div class="col-xl-4 col-lg-3 col-sm-6 col-6">
                              <div>
                                <h6>FONT ICONS</h6>
                                <ul class="fw-normal lh-lg ps-3 ms-1 mt-3 animation_delay">
                                  <li><a href="./docs/icon-fontawesome.html">Font Awesome</a></li>
                                  <li><a href="./docs/icon-linear.html">Simple line</a></li>
                                  <li><a href="./docs/icon-weather.html">Weather Icons</a></li>
                                  <li><a href="./docs/icon-flag.html">Flag Icon</a></li>
                                  <li><a href="./docs/icon-custom.html">SVG Custom Icon</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-6 col-6">
                              <div>
                                <h6>WIDGET CARD'S</h6>
                                <ul class="fw-normal lh-lg ps-3 ms-1 mt-3 animation_delay">
                                  <li><a href="./docs/w-cards.html">Basic Card</a></li>
                                  <li><a href="./docs/w-cards-tiles.html">Card Tiles</a></li>
                                  <li><a href="./docs/w-cards-user.html">User's Card</a></li>
                                  <li><a href="./docs/w-cards-charts.html">Widget Chart</a></li>
                                  <li><a href="./docs/w-cards-tables.html">Card Table</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-6 col-6">
                              <div>
                                <h6>CHARTS</h6>
                                <ul class="fw-normal lh-lg ps-3 ms-1 mt-3 animation_delay">
                                  <li><a href="./docs/chart-apex.html">Apex Chart</a></li>
                                  <li><a href="./docs/chart-chartjs.html">ChartJS</a></li>
                                  <li><a href="./docs/chart-knob.html">JQuery Knob</a></li>
                                  <li><a href="./docs/chart-sparkline.html">Sparkline</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-6 col-6">
                              <div>
                                <h6>ELEMENTS</h6>
                                <ul class="fw-normal lh-lg ps-3 ms-1 mt-3 animation_delay">
                                  <li><a href="./docs/element-clipboard.html">Clipboard</a></li>
                                  <li><a href="./docs/element-imageinput.html">Image Input</a></li>
                                  <li><a href="./docs/element-passwordmeter.html">Password Meter</a></li>
                                  <li><a href="./docs/element-select2.html">Select 2</a></li>
                                  <li><a href="./docs/element-flatpickr.html">Flatpickr</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-6 col-6">
                              <div>
                                <h6>PLUGINS</h6>
                                <ul class="fw-normal lh-lg ps-3 ms-1 mt-3 animation_delay">
                                  <li><a href="./docs/plugin-table.html">DataTables</a></li>
                                  <li><a href="./docs/plugin-summernote.html">Summernote</a></li>
                                  <li><a href="./docs/plugin-owlcarousel.html">Owl Carousel</a></li>
                                  <li><a href="./docs/plugin-fancybox.html">FancyBox Gallery</a></li>
                                  <li><a href="./docs/plugin-rating.html">jQuery Bar Rating</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-sm-6 col-6">
                              <div>
                                <h6>Authentication</h6>
                                <ul class="fw-normal lh-lg ps-3 ms-1 mt-3 animation_delay">
                                  <li><a href="./auth-signin.html">Sign In</a></li>
                                  <li><a href="./auth-signup.html">Sign Up</a></li>
                                  <li><a href="./auth-password-reset.html">Reset Password</a></li>
                                  <li><a href="./auth-404.html">404</a></li>
                                  <li><a href="./auth-lockscreen.html">Lockscreen</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-12">
                          <div class="row g-2">
                            <h5>Quick Links</h5>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                              <div class="row g-2 row-deck">
                                <div class="col-12">
                                  <div class="card bg-success bg-opacity-10">
                                    <div class="card-body">
                                      <h6 class="card-title">Account</h6>
                                      <ul class="fw-normal lh-lg mb-0 list-unstyled animation_delay">
                                        <li><a href="account-settings.html">Settings</a></li>
                                        <li><a href="account-invoices.html">Invoice List</a></li>
                                        <li><a href="account-create-invoices.html">Create Invoices</a></li>
                                        <li><a href="account-billing.html">Billing</a></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="card bg-light-warning lift">
                                    <a class="card-body" href="./app-blog.html">
                                      <i class="fa fa-columns fa-lg mb-3 text-muted"></i>
                                      <h6 class="card-title mb-0">Blog</h6>
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
                              <div class="row g-2 row-deck">
                                <div class="col-6">
                                  <div class="card bg-light-danger lift">
                                    <a href="./docs/doc-changelog.html" class="card-body">
                                      <i class="fa fa-pencil fa-lg mb-2 text-muted"></i>
                                      <h6 class="card-title mb-0">Changelog</h6>
                                    </a>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="card bg-light-info lift">
                                    <a href="./docs/index.html" class="card-body">
                                      <i class="fa fa-file-text fa-lg mb-2 text-muted"></i>
                                      <h6 class="card-title mb-0">Documentation</h6>
                                    </a>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="card bg-light-primary lift">
                                    <a href="./docs/w-cards.html" class="card-body">
                                      <i class="fa fa-puzzle-piece fa-lg mb-2 text-muted"></i>
                                      <h6 class="card-title mb-0">Widget's</h6>
                                    </a>
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="card bg-light-warning lift">
                                    <a href="./docs/helperclass.html" class="card-body">
                                      <i class="fa fa-info-circle fa-lg mb-2 text-muted"></i>
                                      <h6 class="card-title mb-0">Helper class</h6>
                                    </a>
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="card bg-info bg-opacity-10">
                                    <div class="carousel slide" data-bs-ride="carousel">
                                      <div class="carousel-inner">
                                        <div class="carousel-item active" data-bs-interval="1500">
                                          <div class="card-body">
                                            <div class="text-uppercase">File Usage</div>
                                            <div class="mt-2">
                                              <label class="small d-flex justify-content-between">130,347 / 250,000<span>52.14%</span></label>
                                              <div class="progress mt-1" style="height: 2px;">
                                                <div class="progress-bar chart-color1" role="progressbar" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100" style="width: 52%;"></div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="carousel-item" data-bs-interval="1500">
                                          <div class="card-body">
                                            <div class="text-uppercase">MySQL® Disk Usage</div>
                                            <div class="mt-2">
                                              <label class="small d-flex justify-content-between">9.08 GB / 26.2 GB <span>22.74%</span></label>
                                              <div class="progress mt-1" style="height: 2px;">
                                                <div class="progress-bar chart-color1" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%;"></div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="carousel-item" data-bs-interval="1500">
                                          <div class="card-body">
                                            <div class="text-uppercase">MySQL® Databases</div>
                                            <div class="mt-2">
                                              <label class="small d-flex justify-content-between">1 / 1 <span>100%</span></label>
                                              <div class="progress mt-1" style="height: 2px;">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
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
                          </div>
                          <div class="mt-3">
                            <span class="me-2">
                              <i class="fa fa-star text-warning"></i>
                              <i class="fa fa-star text-warning"></i>
                              <i class="fa fa-star text-warning"></i>
                              <i class="fa fa-star text-warning"></i>
                              <i class="fa fa-star text-warning"></i>
                            </span>
                            <span>Rated 4.7/5 in Customer Satisfaction on</span>
                            <a class="avio-link text_bg2 ms-1" href="https://themeforest.net/user/wrraptheme" title="wrraptheme" target="_blank">Themeforest</a>
                          </div>
                        </div>
                        <!-- Start:: menu footer -->
                        <div class="col-12">
                          <footer class="d-flex flex-wrap justify-content-between align-items-center pt-2 border-top">
                            <p class="col-md-5 mb-0 text-muted">© 2022 <a href="javascript:void(0)">AVIO</a>. <span class="fa fa-heart text-danger"></span> by <a href="https://www.thememakker.com/"> ThemeMakker </a></p>
                            <ul class="nav col-md-7 justify-content-end">
                              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Support</a></li>
                              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Purchase</a></li>
                            </ul>
                          </footer>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Header:: icon and user profile -->
              <ul class="nav navbar-right d-flex align-items-center mb-0 list-unstyled">
                <!-- start: quick light dark -->
                <li>
                  <a class="nav-link quick-light-dark" href="#">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path class="fill-secondary" d="M16.589 11.8505C15.1096 12.3407 11.2811 11.5703 10.1035 10.3446C8.926 9.11893 8.62407 5.69285 9.52383 4.49635C10.4236 3.29985 13.926 2.68117 15.5021 3.16561C17.0782 3.65004 18.7992 5.9555 18.9804 7.40297C19.1615 8.85044 18.0685 11.3602 16.589 11.8505C15.1096 12.3407 11.2811 11.5703 10.1035 10.3446L16.589 11.8505Z" />
                      <path class="fill-muted" d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"></path>
                      <path class="fill-muted" d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
                    </svg>
                  </a>
                </li>
                <!-- start: main search -->
                <li>
                  <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#main_search">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path class="fill-secondary" d="M19.8765 6.43047C18.7214 5.14266 5.68328 3.32801 4.2308 4.2529C2.77831 5.17778 8.55395 11.6168 11.1616 11.9798C13.7692 12.3427 21.0316 7.71828 19.8765 6.43047C18.7214 5.14266 5.68328 3.32801 4.2308 4.2529Z" />
                      <path class="fill-muted" d="M14.6775 12.93C15.8879 11.2784 16.43 9.23062 16.1954 7.19644C15.9608 5.16226 14.9668 3.29168 13.4122 1.95892C11.8577 0.626155 9.85721 -0.070492 7.81107 0.00834944C5.76493 0.0871909 3.824 0.935706 2.37661 2.38414C0.929213 3.83257 0.0820868 5.7741 0.00470953 7.8203C-0.0726677 9.86649 0.62541 11.8665 1.95928 13.4201C3.29316 14.9737 5.16445 15.9663 7.1988 16.1995C9.23314 16.4326 11.2805 15.8891 12.9313 14.6775H12.93C12.9675 14.7275 13.0075 14.775 13.0525 14.8213L17.865 19.6338C18.0994 19.8683 18.4174 20.0001 18.749 20.0003C19.0805 20.0004 19.3986 19.8688 19.6331 19.6344C19.8677 19.4 19.9995 19.082 19.9997 18.7504C19.9998 18.4189 19.8682 18.1008 19.6338 17.8663L14.8213 13.0538C14.7766 13.0085 14.7285 12.9667 14.6775 12.9288V12.93ZM15 8.125C15 9.02784 14.8222 9.92184 14.4767 10.756C14.1312 11.5901 13.6248 12.348 12.9864 12.9864C12.348 13.6248 11.5901 14.1312 10.756 14.4767C9.92186 14.8222 9.02786 15 8.12502 15C7.22219 15 6.32819 14.8222 5.49408 14.4767C4.65996 14.1312 3.90207 13.6248 3.26366 12.9864C2.62526 12.348 2.11885 11.5901 1.77335 10.756C1.42785 9.92184 1.25002 9.02784 1.25002 8.125C1.25002 6.30164 1.97435 4.55296 3.26366 3.26364C4.55298 1.97433 6.30166 1.25 8.12502 1.25C9.94839 1.25 11.6971 1.97433 12.9864 3.26364C14.2757 4.55296 15 6.30164 15 8.125V8.125Z" />
                    </svg>
                  </a>
                </li>
                <!-- start: notifications dropdown-menu -->
                <li class="d-none d-sm-inline-block">
                  <div class="dropdown morphing scale-left">
                    <a class="nav-link dropdown-toggle after-none" href="#" role="button" data-bs-toggle="dropdown">
                      <svg width="20" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="fill-secondary" d="M16.589 11.8505C15.1096 12.3407 11.2811 11.5703 10.1035 10.3446C8.926 9.11893 8.62407 5.69285 9.52383 4.49635C10.4236 3.29985 13.926 2.68117 15.5021 3.16561C17.0782 3.65004 18.7992 5.9555 18.9804 7.40297C19.1615 8.85044 18.0685 11.3602 16.589 11.8505C15.1096 12.3407 11.2811 11.5703 10.1035 10.3446L16.589 11.8505Z" />
                        <path class="fill-muted" d="M9 20C9.66304 20 10.2989 19.7366 10.7678 19.2678C11.2366 18.7989 11.5 18.163 11.5 17.5H6.5C6.5 18.163 6.76339 18.7989 7.23223 19.2678C7.70107 19.7366 8.33696 20 9 20ZM9 2.39749L8.00375 2.59874C6.8737 2.82899 5.85791 3.44262 5.12831 4.33577C4.39872 5.22892 4.00012 6.34673 4 7.49999C4 8.28499 3.8325 10.2462 3.42625 12.1775C3.22625 13.1362 2.95625 14.135 2.5975 15H15.4025C15.0437 14.135 14.775 13.1375 14.5737 12.1775C14.1675 10.2462 14 8.28499 14 7.49999C13.9996 6.34694 13.6009 5.22943 12.8713 4.33654C12.1417 3.44365 11.1261 2.8302 9.99625 2.59999L9 2.39624V2.39749ZM16.775 15C17.0538 15.5587 17.3762 16.0012 17.75 16.25H0.25C0.62375 16.0012 0.94625 15.5587 1.225 15C2.35 12.75 2.75 8.59999 2.75 7.49999C2.75 4.47499 4.9 1.94999 7.75625 1.37374C7.7388 1.19994 7.75798 1.0244 7.81254 0.858461C7.8671 0.69252 7.95584 0.539857 8.07303 0.410318C8.19022 0.280778 8.33325 0.177238 8.49292 0.106376C8.65258 0.0355132 8.82532 -0.00109863 9 -0.00109863C9.17468 -0.00109863 9.34742 0.0355132 9.50709 0.106376C9.66675 0.177238 9.80978 0.280778 9.92697 0.410318C10.0442 0.539857 10.1329 0.69252 10.1875 0.858461C10.242 1.0244 10.2612 1.19994 10.2437 1.37374C11.6566 1.66112 12.9267 2.42795 13.839 3.54437C14.7514 4.6608 15.2498 6.05821 15.25 7.49999C15.25 8.59999 15.65 12.75 16.775 15Z" />
                      </svg>
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
                <!-- start: User dropdown-menu -->
                <li>
                  <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2">
                    <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#" role="button" data-bs-toggle="dropdown">
                      <img class="avatar lg img-thumbnail rounded-circle shadow" src="./assets/img/profile_av.png" alt="">
                    </a>
                    <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                      <div class="card w240 overflow-hidden">
                        <div class="card-body">
                          <h6 class="card-title mb-0">Allie Grater</h6>
                          <p class="text-muted">alliegrater@avio.com</p>
                          <a href="auth-signin.html" class="btn bg-secondary text-light text-uppercase w-100">Sign out</a>
                        </div>
                        <div class="list-group m-2">
                          <a class="list-group-item list-group-item-action border-0" href="page-profile.html"><i class="w30 fa fa-user"></i>Profile & account</a>
                          <a class="list-group-item list-group-item-action border-0" href="account-settings.html"><i class="w30 fa fa-gear"></i>Settings</a>
                          <a class="list-group-item list-group-item-action border-0" href="page-support-ticket.html"><i class="w30 fa fa-tag"></i>Support Ticket</a>
                          <a class="list-group-item list-group-item-action border-0" href="page-teamsboard.html"><i class="w30 fa fa-users"></i>Manage team</a>
                          <a class="list-group-item list-group-item-action border-0" href="#"><i class="w30 fa fa-calendar"></i>My Events</a>
                          <a class="list-group-item list-group-item-action border-0" href="account-billing.html"><i class="w30 fa fa-credit-card"></i>Billing</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- start: Settings toggle modal -->
                <li>
                  <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#SettingsModal" title="Settings">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path class="fill-secondary" d="M18.2218 11.6571C16.9027 9.85952 12.8108 7.20851 11.5455 8.22534C10.2803 9.24216 9.31114 15.9605 10.6302 17.7581C11.9494 19.5557 18.1949 20.0278 19.4602 19.011C20.7254 17.9941 19.5409 13.4547 18.2218 11.6571C16.9027 9.85952 12.8108 7.20851 11.5455 8.22534L18.2218 11.6571Z" />
                      <path class="fill-muted" d="M10 5.9425C9.46717 5.9425 8.93955 6.04746 8.44727 6.25136C7.95499 6.45527 7.50769 6.75415 7.13092 7.13092C6.75415 7.50769 6.45527 7.95499 6.25136 8.44727C6.04746 8.93955 5.9425 9.46717 5.9425 10C5.9425 10.5328 6.04746 11.0605 6.25136 11.5527C6.45527 12.045 6.75415 12.4923 7.13092 12.8691C7.50769 13.2459 7.95499 13.5447 8.44727 13.7486C8.93955 13.9526 9.46717 14.0575 10 14.0575C11.0761 14.0575 12.1082 13.63 12.8691 12.8691C13.63 12.1082 14.0575 11.0761 14.0575 10C14.0575 8.92389 13.63 7.89185 12.8691 7.13092C12.1082 6.36999 11.0761 5.9425 10 5.9425ZM7.19251 10C7.19251 9.25541 7.48829 8.54131 8.0148 8.0148C8.54131 7.48829 9.25541 7.19251 10 7.19251C10.7446 7.19251 11.4587 7.48829 11.9852 8.0148C12.5117 8.54131 12.8075 9.25541 12.8075 10C12.8075 10.7446 12.5117 11.4587 11.9852 11.9852C11.4587 12.5117 10.7446 12.8075 10 12.8075C9.25541 12.8075 8.54131 12.5117 8.0148 11.9852C7.48829 11.4587 7.19251 10.7446 7.19251 10Z" />
                      <path class="fill-muted" d="M12.245 1.67874C11.5862 -0.558765 8.41374 -0.558765 7.75498 1.67874L7.63749 2.07749C7.59148 2.23368 7.51111 2.37759 7.40226 2.49868C7.29341 2.61978 7.15884 2.71497 7.00841 2.7773C6.85799 2.83963 6.69552 2.8675 6.53293 2.85888C6.37033 2.85026 6.21173 2.80537 6.06874 2.72749L5.70374 2.52749C3.65374 1.41249 1.41249 3.65499 2.52874 5.70374L2.72749 6.06874C2.80537 6.21173 2.85026 6.37033 2.85888 6.53293C2.8675 6.69552 2.83963 6.85799 2.7773 7.00841C2.71497 7.15884 2.61978 7.29341 2.49868 7.40226C2.37759 7.51111 2.23368 7.59148 2.07749 7.63749L1.67874 7.75498C-0.558765 8.41374 -0.558765 11.5862 1.67874 12.245L2.07749 12.3625C2.23368 12.4085 2.37759 12.4889 2.49868 12.5977C2.61978 12.7066 2.71497 12.8411 2.7773 12.9916C2.83963 13.142 2.8675 13.3044 2.85888 13.467C2.85026 13.6296 2.80537 13.7882 2.72749 13.9312L2.52749 14.2962C1.41249 16.3462 3.65374 18.5887 5.70374 17.4712L6.06874 17.2725C6.21173 17.1946 6.37033 17.1497 6.53293 17.1411C6.69552 17.1325 6.85799 17.1603 7.00841 17.2227C7.15884 17.285 7.29341 17.3802 7.40226 17.5013C7.51111 17.6224 7.59148 17.7663 7.63749 17.9225L7.75498 18.3212C8.41374 20.5587 11.5862 20.5587 12.245 18.3212L12.3625 17.9225C12.4085 17.7663 12.4889 17.6224 12.5977 17.5013C12.7066 17.3802 12.8411 17.285 12.9916 17.2227C13.142 17.1603 13.3044 17.1325 13.467 17.1411C13.6296 17.1497 13.7882 17.1946 13.9312 17.2725L14.2962 17.4725C16.3462 18.5887 18.5887 16.345 17.4712 14.2962L17.2725 13.9312C17.1946 13.7882 17.1497 13.6296 17.1411 13.467C17.1325 13.3044 17.1603 13.142 17.2227 12.9916C17.285 12.8411 17.3802 12.7066 17.5013 12.5977C17.6224 12.4889 17.7663 12.4085 17.9225 12.3625L18.3212 12.245C20.5587 11.5862 20.5587 8.41374 18.3212 7.75498L17.9225 7.63749C17.7663 7.59148 17.6224 7.51111 17.5013 7.40226C17.3802 7.29341 17.285 7.15884 17.2227 7.00841C17.1603 6.85799 17.1325 6.69552 17.1411 6.53293C17.1497 6.37033 17.1946 6.21173 17.2725 6.06874L17.4725 5.70374C18.5887 3.65374 16.345 1.41249 14.2962 2.52874L13.9312 2.72749C13.7882 2.80537 13.6296 2.85026 13.467 2.85888C13.3044 2.8675 13.142 2.83963 12.9916 2.7773C12.8411 2.71497 12.7066 2.61978 12.5977 2.49868C12.4889 2.37759 12.4085 2.23368 12.3625 2.07749L12.245 1.67874ZM8.95374 2.03249C9.26124 0.988735 10.7387 0.988735 11.0462 2.03249L11.1637 2.43124C11.2625 2.76634 11.435 3.0751 11.6686 3.33486C11.9023 3.59462 12.191 3.79881 12.5138 3.93246C12.8366 4.06611 13.1852 4.12582 13.5341 4.10722C13.883 4.08863 14.2232 3.99219 14.53 3.82499L14.8937 3.62499C15.8487 3.10624 16.8937 4.14999 16.3737 5.10624L16.175 5.47123C16.008 5.77802 15.9118 6.11827 15.8934 6.46705C15.875 6.81584 15.9349 7.16432 16.0687 7.48697C16.2024 7.80961 16.4067 8.09824 16.6665 8.33171C16.9262 8.56517 17.2349 8.73756 17.57 8.83624L17.9675 8.95374C19.0112 9.26124 19.0112 10.7387 17.9675 11.0462L17.5687 11.1637C17.2336 11.2625 16.9249 11.435 16.6651 11.6686C16.4053 11.9023 16.2012 12.191 16.0675 12.5138C15.9339 12.8366 15.8742 13.1852 15.8927 13.5341C15.9113 13.883 16.0078 14.2232 16.175 14.53L16.375 14.8937C16.8937 15.8487 15.85 16.8937 14.8937 16.3737L14.53 16.175C14.2232 16.0078 13.8828 15.9114 13.5339 15.8929C13.1849 15.8744 12.8363 15.9342 12.5135 16.068C12.1907 16.2017 11.9019 16.4061 11.6683 16.666C11.4348 16.9259 11.2624 17.2348 11.1637 17.57L11.0462 17.9675C10.7387 19.0112 9.26124 19.0112 8.95374 17.9675L8.83624 17.5687C8.73742 17.2338 8.56493 16.9252 8.3314 16.6656C8.09787 16.406 7.80922 16.2018 7.4866 16.0682C7.16397 15.9346 6.81554 15.8748 6.46682 15.8933C6.1181 15.9118 5.77794 16.008 5.47123 16.175L5.10624 16.375C4.15124 16.8937 3.10624 15.85 3.62624 14.8937L3.82499 14.53C3.99242 14.2232 4.08905 13.8828 4.10777 13.5338C4.12649 13.1848 4.06683 12.836 3.93317 12.513C3.7995 12.1901 3.59523 11.9012 3.33533 11.6675C3.07544 11.4338 2.76652 11.2612 2.43124 11.1625L2.03249 11.045C0.988735 10.7375 0.988735 9.25998 2.03249 8.95249L2.43124 8.83498C2.76599 8.73612 3.07441 8.56366 3.33391 8.33022C3.59342 8.09678 3.79744 7.80827 3.93105 7.4858C4.06466 7.16334 4.12448 6.81508 4.10613 6.46651C4.08778 6.11794 3.99172 5.77789 3.82499 5.47123L3.62499 5.10624C3.10624 4.15124 4.14999 3.10624 5.10624 3.62624L5.47123 3.82499C5.77794 3.99195 6.1181 4.0882 6.46682 4.10668C6.81554 4.12515 7.16397 4.06538 7.4866 3.93176C7.80922 3.79813 8.09787 3.59402 8.3314 3.33439C8.56493 3.07475 8.73742 2.76617 8.83624 2.43124L8.95374 2.03249Z" />
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Start:: Search bar collapse -->
        <div class="page-search collapse" id="main_search">
          <div class="container-fluid">
            <div class="py-4">
              <div class="main-search px-3 flex-fill">
                <input class="form-control" type="text" placeholder="Enter your search key word">
                <div class="card shadow rounded-4 search-result slidedown">
                  <div class="card-body">
                    <small class="text-uppercase text-muted">Recent searches</small>
                    <div class="d-flex flex-wrap align-items-start mt-2 mb-4">
                      <a class="small rounded py-1 px-2 m-1 fw-normal bg-primary text-white" href="#">HRMS Admin</a>
                      <a class="small rounded py-1 px-2 m-1 fw-normal bg-secondary text-white" href="#">Hospital Admin</a>
                      <a class="small rounded py-1 px-2 m-1 fw-normal bg-info text-white" href="./app-project.html">Project</a>
                      <a class="small rounded py-1 px-2 m-1 fw-normal bg-dark text-white" href="./app-social.html">Social App</a>
                      <a class="small rounded py-1 px-2 m-1 fw-normal bg-danger text-white" href="#">University Admin</a>
                    </div>
                    <small class="text-uppercase text-muted">Suggestions</small>
                    <div class="card list-group list-group-flush list-group-custom mt-2">
                      <a class="list-group-item list-group-item-action text-truncate" href=".//docs/doc-helperclass.html">
                        <div class="fw-bold">Helper Class</div>
                        <small class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                      </a>
                      <a class="list-group-item list-group-item-action text-truncate" href=".//docs/element-daterange.html">
                        <div class="fw-bold">Date Range Picker</div>
                        <small class="text-muted">There are many variations of passages of Lorem Ipsum available</small>
                      </a>
                      <a class="list-group-item list-group-item-action text-truncate" href=".//docs/element-imageinput.html">
                        <div class="fw-bold">Image Input</div>
                        <small class="text-muted">It is a long established fact that a reader will be distracted</small>
                      </a>
                      <a class="list-group-item list-group-item-action text-truncate" href=".//docs/plugin-table.html">
                        <div class="fw-bold">DataTables for jQuery</div>
                        <small class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                      </a>
                      <a class="list-group-item list-group-item-action text-truncate" href=".//docs/doc-setup.html">
                        <div class="fw-bold">Development Setup</div>
                        <small class="text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text.</small>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Start:: breadcrumb, btn action, and quick tab bar -->
        <div class="page-header pattern-bg">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12 mb-2">
                <ol class="breadcrumb mb-2">
                  <li class="breadcrumb-item"><a href="../index.html">Avio</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
                <div class="d-flex justify-content-between align-items-center">
                  <h1 class="h2 mb-md-0 text-white fw-light">Avio Analytics</h1>
                  <div class="page-action">
                    <!-- btn:: create new project -->
                    <button class="btn d-none d-sm-inline-flex rounded-pill" data-bs-toggle="modal" data-bs-target="#create_project" type="button">
                      <span class="me-1 d-none d-lg-inline-block">Create</span>
                      <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0V0Z" fill="white" />
                      </svg>
                    </button>
                    <!-- btn:: Filter -->
                    <div class="btn-group">
                      <button type="button" class="btn dropdown-toggle after-none rounded-pill" data-bs-toggle="dropdown">
                        <span class="me-1 d-none d-lg-inline-block">Filter</span>
                        <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0 1.00018C0 0.867575 0.0526784 0.740398 0.146447 0.64663C0.240215 0.552862 0.367392 0.500183 0.5 0.500183H12.5C12.6326 0.500183 12.7598 0.552862 12.8536 0.64663C12.9473 0.740398 13 0.867575 13 1.00018V3.00018C13 3.12349 12.9544 3.24244 12.872 3.33418L8.5 8.19218V13.0002C8.49992 13.1051 8.46685 13.2073 8.40547 13.2924C8.3441 13.3774 8.25752 13.441 8.158 13.4742L5.158 14.4742C5.08287 14.4992 5.00288 14.506 4.9246 14.4941C4.84632 14.4821 4.772 14.4518 4.70775 14.4055C4.6435 14.3592 4.59116 14.2983 4.55504 14.2279C4.51893 14.1574 4.50006 14.0794 4.5 14.0002V8.19218L0.128 3.33418C0.0456082 3.24244 2.21504e-05 3.12349 0 3.00018V1.00018ZM1 1.50018V2.80818L5.372 7.66618C5.45439 7.75792 5.49998 7.87688 5.5 8.00018V13.3062L7.5 12.6402V8.00018C7.50002 7.87688 7.54561 7.75792 7.628 7.66618L12 2.80818V1.50018H1Z" fill="white" />
                        </svg>
                      </button>
                      <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">Yesterday</a></li>
                        <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                        <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">Last Month</a></li>
                        <li>
                          <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Custom Range</a></li>
                      </ul>
                    </div>
                    <!-- btn:: more action -->
                    <div class="btn-group">
                      <button type="button" class="btn dropdown-toggle after-none rounded-pill" data-bs-toggle="dropdown">
                        <svg viewBox="0 0 16 16" width="16px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path d="M2 10H5C5.26522 10 5.51957 10.1054 5.70711 10.2929C5.89464 10.4804 6 10.7348 6 11V14C6 14.2652 5.89464 14.5196 5.70711 14.7071C5.51957 14.8946 5.26522 15 5 15H2C1.73478 15 1.48043 14.8946 1.29289 14.7071C1.10536 14.5196 1 14.2652 1 14V11C1 10.7348 1.10536 10.4804 1.29289 10.2929C1.48043 10.1054 1.73478 10 2 10ZM11 1H14C14.2652 1 14.5196 1.10536 14.7071 1.29289C14.8946 1.48043 15 1.73478 15 2V5C15 5.26522 14.8946 5.51957 14.7071 5.70711C14.5196 5.89464 14.2652 6 14 6H11C10.7348 6 10.4804 5.89464 10.2929 5.70711C10.1054 5.51957 10 5.26522 10 5V2C10 1.73478 10.1054 1.48043 10.2929 1.29289C10.4804 1.10536 10.7348 1 11 1ZM11 10C10.7348 10 10.4804 10.1054 10.2929 10.2929C10.1054 10.4804 10 10.7348 10 11V14C10 14.2652 10.1054 14.5196 10.2929 14.7071C10.4804 14.8946 10.7348 15 11 15H14C14.2652 15 14.5196 14.8946 14.7071 14.7071C14.8946 14.5196 15 14.2652 15 14V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10H11ZM11 0C10.4696 0 9.96086 0.210714 9.58579 0.585786C9.21071 0.960859 9 1.46957 9 2V5C9 5.53043 9.21071 6.03914 9.58579 6.41421C9.96086 6.78929 10.4696 7 11 7H14C14.5304 7 15.0391 6.78929 15.4142 6.41421C15.7893 6.03914 16 5.53043 16 5V2C16 1.46957 15.7893 0.960859 15.4142 0.585786C15.0391 0.210714 14.5304 0 14 0L11 0ZM2 9C1.46957 9 0.960859 9.21071 0.585786 9.58579C0.210714 9.96086 0 10.4696 0 11L0 14C0 14.5304 0.210714 15.0391 0.585786 15.4142C0.960859 15.7893 1.46957 16 2 16H5C5.53043 16 6.03914 15.7893 6.41421 15.4142C6.78929 15.0391 7 14.5304 7 14V11C7 10.4696 6.78929 9.96086 6.41421 9.58579C6.03914 9.21071 5.53043 9 5 9H2ZM9 11C9 10.4696 9.21071 9.96086 9.58579 9.58579C9.96086 9.21071 10.4696 9 11 9H14C14.5304 9 15.0391 9.21071 15.4142 9.58579C15.7893 9.96086 16 10.4696 16 11V14C16 14.5304 15.7893 15.0391 15.4142 15.4142C15.0391 15.7893 14.5304 16 14 16H11C10.4696 16 9.96086 15.7893 9.58579 15.4142C9.21071 15.0391 9 14.5304 9 14V11Z" fill="white"></path>
                          <path class="fill-secondary" d="M0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V5C0 5.53043 0.210714 6.03914 0.585786 6.41421C0.960859 6.78929 1.46957 7 2 7H5C5.53043 7 6.03914 6.78929 6.41421 6.41421C6.78929 6.03914 7 5.53043 7 5V2C7 1.46957 6.78929 0.960859 6.41421 0.585786C6.03914 0.210714 5.53043 0 5 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786Z"></path>
                        </svg>
                      </button>
                      <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li>
                          <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                      </ul>
                    </div>
                    <!-- btn:: recent chat -->
                    <button class="btn d-none d-sm-inline-flex rounded-pill" data-bs-toggle="modal" data-bs-target="#recent_chat" type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"></path>
                      </svg>
                    </button>
                    <!-- btn:: download -->
                    <button class="btn d-none d-sm-inline-flex bg-secondary rounded-pill" type="button">
                      <span class="me-1 d-none d-lg-inline-block">Download</span>
                      <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.64602 9.354C7.69247 9.40056 7.74764 9.43751 7.80839 9.46271C7.86913 9.48792 7.93425 9.50089 8.00002 9.50089C8.06579 9.50089 8.13091 9.48792 8.19165 9.46271C8.2524 9.43751 8.30758 9.40056 8.35402 9.354L10.354 7.354C10.4005 7.30751 10.4374 7.25232 10.4625 7.19158C10.4877 7.13084 10.5007 7.06574 10.5007 7C10.5007 6.93426 10.4877 6.86916 10.4625 6.80842C10.4374 6.74768 10.4005 6.69249 10.354 6.646C10.3075 6.59951 10.2523 6.56264 10.1916 6.53748C10.1309 6.51232 10.0658 6.49937 10 6.49937C9.93428 6.49937 9.86918 6.51232 9.80844 6.53748C9.7477 6.56264 9.69251 6.59951 9.64602 6.646L8.50002 7.793V4C8.50002 3.86739 8.44734 3.74021 8.35358 3.64645C8.25981 3.55268 8.13263 3.5 8.00002 3.5C7.86741 3.5 7.74024 3.55268 7.64647 3.64645C7.5527 3.74021 7.50002 3.86739 7.50002 4V7.793L6.35402 6.646C6.26013 6.55211 6.1328 6.49937 6.00002 6.49937C5.86725 6.49937 5.73991 6.55211 5.64602 6.646C5.55213 6.73989 5.49939 6.86722 5.49939 7C5.49939 7.13278 5.55213 7.26011 5.64602 7.354L7.64602 9.354Z" fill="white" />
                        <path d="M4.406 1.842C5.40548 0.980135 6.68024 0.504139 8 0.5C10.69 0.5 12.923 2.5 13.166 5.079C14.758 5.304 16 6.637 16 8.273C16 10.069 14.502 11.5 12.687 11.5H3.781C1.708 11.5 0 9.866 0 7.818C0 6.055 1.266 4.595 2.942 4.225C3.085 3.362 3.64 2.502 4.406 1.842ZM5.059 2.599C4.302 3.252 3.906 4.039 3.906 4.655V5.103L3.461 5.152C2.064 5.305 1 6.452 1 7.818C1 9.285 2.23 10.5 3.781 10.5H12.687C13.98 10.5 15 9.488 15 8.273C15 7.057 13.98 6.045 12.687 6.045H12.187V5.545C12.188 3.325 10.328 1.5 8 1.5C6.91988 1.50431 5.87684 1.89443 5.059 2.6V2.599Z" fill="white" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div> <!-- row:: End -->
            <div class="row g-3 my-md-3 justify-content-between">
              <div class="col-xxl-8 col-xl-8 col-lg-12">
                <div class="ph-tab">
                  <input checked="checked" id="tab1" type="radio" name="pct" />
                  <input id="tab2" type="radio" name="pct" />
                  <input id="tab3" type="radio" name="pct" />
                  <nav>
                    <ul>
                      <li class="tab1"><label for="tab1">Summary</label></li>
                      <li class="tab2"><label for="tab2">Crypto</label></li>
                      <li class="tab3"><label for="tab3">Recently</label></li>
                    </ul>
                  </nav>
                  <section>
                    <!-- tab content:: Summary -->
                    <div class="tab1 rounded-4">
                      <div class="owl-carousel owl-theme owl_summary">
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-3" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path class="fill-muted" d="M16 1.9L29.22 8H31C31.2652 8 31.5196 8.10536 31.7071 8.29289C31.8946 8.48043 32 8.73479 32 9V13C32 13.2652 31.8946 13.5196 31.7071 13.7071C31.5196 13.8946 31.2652 14 31 14H30V28C30.2231 28.0001 30.4397 28.0747 30.6155 28.2121C30.7912 28.3494 30.916 28.5416 30.97 28.758L31.97 32.758C32.0068 32.9054 32.0095 33.0592 31.9779 33.2078C31.9463 33.3564 31.8813 33.4958 31.7878 33.6155C31.6943 33.7352 31.5748 33.8321 31.4383 33.8987C31.3018 33.9653 31.1519 34 31 34H1C0.848102 34 0.69821 33.9653 0.561701 33.8987C0.425191 33.8321 0.305652 33.7352 0.212156 33.6155C0.11866 33.4958 0.0536638 33.3564 0.0221017 33.2078C-0.00946033 33.0592 -0.00675923 32.9054 0.03 32.758L1.03 28.758C1.08398 28.5416 1.20878 28.3494 1.38454 28.2121C1.5603 28.0747 1.77694 28.0001 2 28V14H1C0.734784 14 0.48043 13.8946 0.292893 13.7071C0.105357 13.5196 0 13.2652 0 13V9C0 8.73479 0.105357 8.48043 0.292893 8.29289C0.48043 8.10536 0.734784 8 1 8H2.78L16 1.9ZM7.552 8H24.446L16 4.1L7.552 8ZM4 14V28H6V14H4ZM8 14V28H13V14H8ZM15 14V28H17V14H15ZM19 14V28H24V14H19ZM26 14V28H28V14H26ZM30 12V10H2V12H30ZM29.22 30H2.78L2.28 32H29.72L29.22 30Z" />
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Income</p>
                            <h5 class="mb-0">$12,251.00</h5>
                          </div>
                        </div>
                        <div class="item card bg-secondary text-white">
                          <div class="card-body">
                            <svg class="mb-3" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11 19.022C11.152 20.93 12.66 22.416 15.364 22.592V24H16.564V22.582C19.364 22.386 21 20.89 21 18.718C21 16.744 19.748 15.726 17.51 15.198L16.564 14.974V11.14C17.764 11.276 18.528 11.932 18.712 12.84H20.816C20.664 11.002 19.088 9.564 16.564 9.408V8H15.364V9.438C12.974 9.672 11.344 11.11 11.344 13.144C11.344 14.944 12.556 16.088 14.57 16.558L15.364 16.754V20.822C14.134 20.636 13.32 19.962 13.136 19.022H11ZM15.354 14.69C14.174 14.416 13.534 13.858 13.534 13.018C13.534 12.078 14.224 11.374 15.364 11.168V14.688H15.354V14.69ZM16.738 17.076C18.172 17.408 18.834 17.946 18.834 18.896C18.834 19.98 18.01 20.724 16.564 20.86V17.036L16.738 17.076Z" fill="white" />
                              <path d="M16 30C12.287 30 8.72601 28.525 6.1005 25.8995C3.475 23.274 2 19.713 2 16C2 12.287 3.475 8.72601 6.1005 6.1005C8.72601 3.475 12.287 2 16 2C19.713 2 23.274 3.475 25.8995 6.1005C28.525 8.72601 30 12.287 30 16C30 19.713 28.525 23.274 25.8995 25.8995C23.274 28.525 19.713 30 16 30ZM16 32C20.2435 32 24.3131 30.3143 27.3137 27.3137C30.3143 24.3131 32 20.2435 32 16C32 11.7565 30.3143 7.68687 27.3137 4.68629C24.3131 1.68571 20.2435 0 16 0C11.7565 0 7.68687 1.68571 4.68629 4.68629C1.68571 7.68687 0 11.7565 0 16C0 20.2435 1.68571 24.3131 4.68629 27.3137C7.68687 30.3143 11.7565 32 16 32Z" fill="white" />
                              <path d="M16 27C13.0826 27 10.2847 25.8411 8.22183 23.7782C6.15893 21.7153 5 18.9174 5 16C5 13.0826 6.15893 10.2847 8.22183 8.22183C10.2847 6.15893 13.0826 5 16 5C18.9174 5 21.7153 6.15893 23.7782 8.22183C25.8411 10.2847 27 13.0826 27 16C27 18.9174 25.8411 21.7153 23.7782 23.7782C21.7153 25.8411 18.9174 27 16 27ZM16 28C17.5759 28 19.1363 27.6896 20.5922 27.0866C22.0481 26.4835 23.371 25.5996 24.4853 24.4853C25.5996 23.371 26.4835 22.0481 27.0866 20.5922C27.6896 19.1363 28 17.5759 28 16C28 14.4241 27.6896 12.8637 27.0866 11.4078C26.4835 9.95189 25.5996 8.62902 24.4853 7.51472C23.371 6.40042 22.0481 5.5165 20.5922 4.91345C19.1363 4.31039 17.5759 4 16 4C12.8174 4 9.76515 5.26428 7.51472 7.51472C5.26428 9.76515 4 12.8174 4 16C4 19.1826 5.26428 22.2348 7.51472 24.4853C9.76515 26.7357 12.8174 28 16 28Z" fill="white" />
                            </svg>
                            <p class="small text-uppercase mb-1">Profit</p>
                            <h5 class="mb-0">$6,100.00</h5>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-3" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path class="fill-muted" d="M0 4C0 2.93913 0.421427 1.92172 1.17157 1.17157C1.92172 0.421427 2.93913 0 4 0H28C29.0609 0 30.0783 0.421427 30.8284 1.17157C31.5786 1.92172 32 2.93913 32 4V20C32 21.0609 31.5786 22.0783 30.8284 22.8284C30.0783 23.5786 29.0609 24 28 24H4C2.93913 24 1.92172 23.5786 1.17157 22.8284C0.421427 22.0783 0 21.0609 0 20V4ZM4 2C3.46957 2 2.96086 2.21071 2.58579 2.58579C2.21071 2.96086 2 3.46957 2 4V6H30V4C30 3.46957 29.7893 2.96086 29.4142 2.58579C29.0391 2.21071 28.5304 2 28 2H4ZM30 10H2V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H28C28.5304 22 29.0391 21.7893 29.4142 21.4142C29.7893 21.0391 30 20.5304 30 20V10Z" />
                              <path class="fill-muted" d="M4 16C4 15.4696 4.21071 14.9609 4.58579 14.5858C4.96086 14.2107 5.46957 14 6 14H8C8.53043 14 9.03914 14.2107 9.41421 14.5858C9.78929 14.9609 10 15.4696 10 16V18C10 18.5304 9.78929 19.0391 9.41421 19.4142C9.03914 19.7893 8.53043 20 8 20H6C5.46957 20 4.96086 19.7893 4.58579 19.4142C4.21071 19.0391 4 18.5304 4 18V16Z" />
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Expense</p>
                            <h5 class="mb-0">$4,351.00</h5>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-3" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path class="fill-muted" d="M2 3C2 2.20435 2.31607 1.44129 2.87868 0.87868C3.44129 0.31607 4.20435 0 5 0L29 0C29.7956 0 30.5587 0.31607 31.1213 0.87868C31.6839 1.44129 32 2.20435 32 3V29C32 29.7956 31.6839 30.5587 31.1213 31.1213C30.5587 31.6839 29.7956 32 29 32H5C4.20435 32 3.44129 31.6839 2.87868 31.1213C2.31607 30.5587 2 29.7956 2 29V26H1C0.734784 26 0.48043 25.8946 0.292893 25.7071C0.105357 25.5196 0 25.2652 0 25C0 24.7348 0.105357 24.4804 0.292893 24.2929C0.48043 24.1054 0.734784 24 1 24H2V17H1C0.734784 17 0.48043 16.8946 0.292893 16.7071C0.105357 16.5196 0 16.2652 0 16C0 15.7348 0.105357 15.4804 0.292893 15.2929C0.48043 15.1054 0.734784 15 1 15H2V8H1C0.734784 8 0.48043 7.89464 0.292893 7.70711C0.105357 7.51957 0 7.26522 0 7C0 6.73478 0.105357 6.48043 0.292893 6.29289C0.48043 6.10536 0.734784 6 1 6H2V3ZM5 2C4.73478 2 4.48043 2.10536 4.29289 2.29289C4.10536 2.48043 4 2.73478 4 3V29C4 29.2652 4.10536 29.5196 4.29289 29.7071C4.48043 29.8946 4.73478 30 5 30H29C29.2652 30 29.5196 29.8946 29.7071 29.7071C29.8946 29.5196 30 29.2652 30 29V3C30 2.73478 29.8946 2.48043 29.7071 2.29289C29.5196 2.10536 29.2652 2 29 2H5Z" />
                              <path class="fill-muted" d="M27 12C27.2652 12 27.5195 12.1054 27.7071 12.2929C27.8946 12.4804 28 12.7348 28 13V19C28 19.2652 27.8946 19.5196 27.7071 19.7071C27.5195 19.8946 27.2652 20 27 20C26.7348 20 26.4804 19.8946 26.2929 19.7071C26.1053 19.5196 26 19.2652 26 19V13C26 12.7348 26.1053 12.4804 26.2929 12.2929C26.4804 12.1054 26.7348 12 27 12ZM9.65597 8.928C9.74886 8.83487 9.85921 8.76099 9.9807 8.71058C10.1022 8.66016 10.2324 8.63421 10.364 8.63421C10.4955 8.63421 10.6257 8.66016 10.7472 8.71058C10.8687 8.76099 10.9791 8.83487 11.072 8.928L13.252 11.108C14.2677 10.3871 15.4824 9.9999 16.728 9.9999C17.9735 9.9999 19.1882 10.3871 20.204 11.108L22.384 8.928C22.5717 8.74049 22.8263 8.63526 23.0917 8.63544C23.357 8.63563 23.6115 8.74123 23.799 8.929C23.9865 9.11677 24.0917 9.37134 24.0915 9.63671C24.0913 9.90207 23.9857 10.1565 23.798 10.344L21.618 12.524C23.098 14.598 23.098 17.404 21.618 19.476L23.798 21.656C23.9857 21.8435 24.0913 22.0979 24.0915 22.3633C24.0917 22.6287 23.9865 22.8832 23.799 23.071C23.6115 23.2588 23.357 23.3644 23.0917 23.3646C22.8263 23.3647 22.5717 23.2595 22.384 23.072L20.204 20.892C19.1883 21.6131 17.9736 22.0005 16.728 22.0005C15.4824 22.0005 14.2676 21.6131 13.252 20.892L11.072 23.072C10.979 23.165 10.8686 23.2387 10.7471 23.289C10.6257 23.3394 10.4955 23.3653 10.364 23.3653C10.2325 23.3653 10.1023 23.3394 9.9808 23.289C9.85932 23.2387 9.74895 23.165 9.65597 23.072C9.56299 22.979 9.48924 22.8686 9.43892 22.7472C9.38861 22.6257 9.36271 22.4955 9.36271 22.364C9.36271 22.2325 9.38861 22.1023 9.43892 21.9808C9.48924 21.8594 9.56299 21.749 9.65597 21.656L11.836 19.476C11.1151 18.4603 10.7279 17.2455 10.7279 16C10.7279 14.7545 11.1151 13.5397 11.836 12.524L9.65597 10.344C9.56284 10.2511 9.48896 10.1408 9.43855 10.0193C9.38813 9.89778 9.36218 9.76753 9.36218 9.636C9.36218 9.50447 9.38813 9.37422 9.43855 9.25273C9.48896 9.13124 9.56284 9.02089 9.65597 8.928ZM13.9 13.172C13.5179 13.541 13.2132 13.9824 13.0036 14.4704C12.7939 14.9584 12.6836 15.4833 12.679 16.0144C12.6744 16.5455 12.7756 17.0722 12.9767 17.5638C13.1778 18.0554 13.4748 18.502 13.8504 18.8776C14.226 19.2532 14.6726 19.5502 15.1642 19.7513C15.6557 19.9524 16.1825 20.0536 16.7136 20.049C17.2447 20.0444 17.7696 19.934 18.2576 19.7244C18.7456 19.5148 19.187 19.21 19.556 18.828C20.2846 18.0736 20.6878 17.0632 20.6787 16.0144C20.6696 14.9656 20.2489 13.9624 19.5072 13.2207C18.7656 12.4791 17.7624 12.0584 16.7136 12.0493C15.6648 12.0402 14.6544 12.4434 13.9 13.172Z" />
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Revenue</p>
                            <h5 class="mb-0">$9,780.00</h5>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-3" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path class="fill-muted" d="M16 16.1C17.3261 16.1 18.5979 15.5732 19.5355 14.6355C20.4732 13.6979 21 12.4261 21 11.1C21 9.77392 20.4732 8.50215 19.5355 7.56446C18.5979 6.62678 17.3261 6.1 16 6.1C14.6739 6.1 13.4021 6.62678 12.4645 7.56446C11.5268 8.50215 11 9.77392 11 11.1C11 12.4261 11.5268 13.6979 12.4645 14.6355C13.4021 15.5732 14.6739 16.1 16 16.1V16.1Z" />
                              <path class="fill-muted" d="M2 0C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2L0 24C0 24.5304 0.210714 25.0391 0.585786 25.4142C0.960859 25.7893 1.46957 26 2 26H3C3.26522 26 3.51957 25.8946 3.70711 25.7071C3.89464 25.5196 4 25.2652 4 25C4 24.7348 4.10536 24.4804 4.29289 24.2929C4.48043 24.1054 4.73478 24 5 24C5.26522 24 5.51957 24.1054 5.70711 24.2929C5.89464 24.4804 6 24.7348 6 25C6 25.2652 6.10536 25.5196 6.29289 25.7071C6.48043 25.8946 6.73478 26 7 26H25C25.2652 26 25.5196 25.8946 25.7071 25.7071C25.8946 25.5196 26 25.2652 26 25C26 24.7348 26.1054 24.4804 26.2929 24.2929C26.4804 24.1054 26.7348 24 27 24C27.2652 24 27.5196 24.1054 27.7071 24.2929C27.8946 24.4804 28 24.7348 28 25C28 25.2652 28.1054 25.5196 28.2929 25.7071C28.4804 25.8946 28.7348 26 29 26H30C30.5304 26 31.0391 25.7893 31.4142 25.4142C31.7893 25.0391 32 24.5304 32 24V4C32 3.46957 31.7893 2.96086 31.4142 2.58579C31.0391 2.21071 30.5304 2 30 2H13.414L12 0.586C11.625 0.210901 11.1164 0.000113275 10.586 0H2ZM2 2H10.586L12 3.414C12.375 3.7891 12.8836 3.99989 13.414 4H30V24H29.83C29.6667 23.5387 29.3931 23.1243 29.0329 22.7929C28.6727 22.4616 28.2369 22.2235 27.7636 22.0992C27.2902 21.9749 26.7937 21.9684 26.3172 22.0801C25.8407 22.1918 25.3988 22.4183 25.03 22.74C23.77 20.446 21.108 18 16 18C10.89 18 8.228 20.448 6.972 22.74C6.60318 22.4183 6.16127 22.1918 5.6848 22.0801C5.20833 21.9684 4.71177 21.9749 4.23842 22.0992C3.76507 22.2235 3.3293 22.4616 2.96912 22.7929C2.60894 23.1243 2.33528 23.5387 2.172 24H2V2Z" />
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Total Visitors</p>
                            <h5 class="mb-0">182,801</h5>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-3" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path class="fill-muted" d="M16 30C12.287 30 8.72601 28.525 6.1005 25.8995C3.475 23.274 2 19.713 2 16C2 12.287 3.475 8.72601 6.1005 6.1005C8.72601 3.475 12.287 2 16 2C19.713 2 23.274 3.475 25.8995 6.1005C28.525 8.72601 30 12.287 30 16C30 19.713 28.525 23.274 25.8995 25.8995C23.274 28.525 19.713 30 16 30ZM16 32C20.2435 32 24.3131 30.3143 27.3137 27.3137C30.3143 24.3131 32 20.2435 32 16C32 11.7565 30.3143 7.68687 27.3137 4.68629C24.3131 1.68571 20.2435 0 16 0C11.7565 0 7.68687 1.68571 4.68629 4.68629C1.68571 7.68687 0 11.7565 0 16C0 20.2435 1.68571 24.3131 4.68629 27.3137C7.68687 30.3143 11.7565 32 16 32V32Z" />
                              <path class="fill-muted" d="M8.56998 19.134C8.79966 19.0014 9.0726 18.9655 9.32878 19.0341C9.58495 19.1027 9.80337 19.2703 9.93598 19.5C10.5502 20.5647 11.4341 21.4487 12.4986 22.0632C13.5632 22.6776 14.7708 23.0007 16 23C17.2291 23.0007 18.4368 22.6776 19.5013 22.0632C20.5659 21.4487 21.4498 20.5647 22.064 19.5C22.1292 19.3854 22.2164 19.2847 22.3206 19.2039C22.4248 19.1231 22.544 19.0637 22.6713 19.0292C22.7986 18.9946 22.9314 18.9856 23.0622 19.0026C23.193 19.0196 23.3191 19.0623 23.4333 19.1282C23.5475 19.1942 23.6476 19.2821 23.7277 19.3868C23.8078 19.4916 23.8664 19.6112 23.9001 19.7387C23.9338 19.8662 23.9419 19.9991 23.9241 20.1297C23.9062 20.2604 23.8627 20.3862 23.796 20.5C23.0062 21.8687 21.8699 23.0052 20.5013 23.7952C19.1327 24.5852 17.5802 25.0007 16 25C14.4198 25.0007 12.8672 24.5852 11.4987 23.7952C10.1301 23.0052 8.99373 21.8687 8.20398 20.5C8.07138 20.2703 8.03544 19.9974 8.10408 19.7412C8.17272 19.485 8.34031 19.2666 8.56998 19.134ZM14 13C14 14.656 13.104 16 12 16C10.896 16 9.99998 14.656 9.99998 13C9.99998 11.344 10.896 10 12 10C13.104 10 14 11.344 14 13ZM22 13C22 14.656 21.104 16 20 16C18.896 16 18 14.656 18 13C18 11.344 18.896 10 20 10C21.104 10 22 11.344 22 13Z" />
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Happy Clients</p>
                            <h5 class="mb-0">2,000+</h5>
                          </div>
                        </div>
                      </div>
                      <script src="./assets/js/bundle/owlcarousel.bundle.js"></script>
                      <script>
                        var owl = $('.owl_summary');
                        owl.owlCarousel({
                          items: 4,
                          margin: 10,
                          autoplayTimeout: 2000,
                          dots: false,
                          autoplay: true,
                          loop: true,
                          autoplayHoverPause: true,
                          responsive: {
                            0: {
                              items: 1
                            },
                            768: {
                              items: 2
                            },
                            1000: {
                              items: 4
                            },
                            1300: {
                              items: 3
                            },
                            1700: {
                              items: 4
                            },
                          }
                        });
                      </script>
                    </div>
                    <!-- tab content::  Crypto-->
                    <div class="tab2 rounded-4">
                      <div class="owl-carousel owl-theme" id="live_coins">
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 65">
                              <g fill="none" fill-rule="nonzero">
                                <circle cx="31.7" cy="32.5" r="31.7" fill="#F5B300" />
                                <path fill="#FFF" d="M23.1 16.3c1.1.3 2.2.5 3.3.8 1.1.3 2.2.5 3.3.8.3.1.4 0 .5-.3.4-1.7.8-3.3 1.2-5 .1-.3.2-.4.5-.3 1 .3 1.9.5 2.9.7.3.1.3.2.2.4-.4 1.6-.8 3.3-1.2 4.9 0 .1 0 .2-.1.4.8.2 1.7.4 2.5.6.1 0 .2-.2.3-.3.3-1.3.6-2.5 1-3.8l.3-1.2c0-.2.1-.3.3-.2 1 .3 2 .5 3.1.8.1 0 .1.1.2.1-.3 1.3-.6 2.5-.9 3.7-.1.5-.2 1-.4 1.5-.1.3 0 .4.3.5l3.3 1.5c1 .6 1.9 1.4 2.6 2.4.9 1.5 1 3.1.6 4.7-.3 1.1-.7 2.1-1.5 2.9-.6.6-1.4 1-2.2 1.3-.1 0-.2.1-.4.1.4.3.8.5 1.2.8 1.2.9 2 2 2.4 3.4.2 1.1.1 2.3-.2 3.4-.4 1.4-.9 2.6-1.8 3.7-1.1 1.3-2.5 2-4.1 2.2-2.1.3-4.1.1-6.1-.2-.3-.1-.5 0-.6.3-.4 1.6-.8 3.3-1.2 4.9-.1.4-.1.5-.6.3-.9-.2-1.9-.5-2.8-.7-.3-.1-.3-.2-.2-.4.4-1.7.8-3.4 1.3-5 0-.2.1-.3-.1-.4-.8-.2-1.6-.4-2.5-.6-.2.9-.5 1.8-.7 2.7-.2.9-.5 1.8-.7 2.7-.1.2-.1.3-.4.2-1-.3-2-.5-3-.7-.3-.1-.3-.2-.2-.4.4-1.7.8-3.4 1.3-5 0-.1.1-.2.1-.4-2.3-.6-4.6-1.2-7-1.8.2-.4.3-.7.5-1.1.4-.9.8-1.8 1.1-2.6.1-.3.2-.3.5-.3.7.2 1.5.4 2.2.5.8.2 1.4-.2 1.5-.9 1.3-5.1 2.6-10.2 3.8-15.4.2-.8-.3-1.7-1.2-2-.9-.3-1.8-.5-2.6-.7-.2 0-.3-.1-.2-.3.3-1.1.6-2.3.9-3.4-.4.3-.4.3-.3.2zM28.2 41c.1 0 .2.1.2.1 1.6.4 3.3.9 5 1 1.2.1 2.3.1 3.4-.3 1.9-.6 2.7-3.1 1.6-4.7-.5-.8-1.3-1.3-2.1-1.8-1.8-1-3.9-1.4-5.9-1.8-.3-.1-.3 0-.4.3-.2 1-.5 1.9-.7 2.9-.4 1.4-.7 2.8-1.1 4.3zm8.4-10.2c.2 0 .7-.1 1.1-.2 1.9-.4 2.9-2.6 1.9-4.3-.5-.9-1.4-1.5-2.3-1.9-1.4-.6-2.8-.9-4.3-1.3-.3-.1-.4 0-.5.3-.5 2.1-1 4.1-1.6 6.2-.1.2 0 .3.2.4.4.1.7.2 1.1.3 1.5.2 2.8.5 4.4.5z" />
                              </g>
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Bitcoin <span class="small text-success">+1.25 <i class="fa fa-level-up"></i></span></p>
                            <h6 class="mb-0 fw-bold">0.000242 BTC</h6>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 65">
                              <path xmlns="http://www.w3.org/2000/svg" fill="#3A74BE" fill-rule="nonzero" d="M31.7.8C14.2.8 0 15 0 32.5s14.2 31.7 31.7 31.7S63.4 50 63.4 32.5 49.2.8 31.7.8zm-19 34.3v-.2c.3-.8.6-1.6.9-2.5.3-.8.5-1.6.8-2.4.1-.2.2-.3.4-.3h13.5c0 .1-.1.3-.1.4l-1.5 4.5c-.1.3-.2.4-.6.4h-13c-.1.1-.3.1-.4.1zm38-9.2c-1.3 4-2.6 8-3.9 12.1-.8 2.5-4.2 5.8-7.9 5.7-8.3-.1-16.6 0-24.8 0h-.5c.1-.3.2-.6.3-.8.5-1.4 1-2.9 1.4-4.3.1-.4.3-.4.6-.4h22.4c.3 0 .5-.1.6-.4 1.1-3.5 2.3-7 3.4-10.5 0-.1.1-.2.1-.4H19.1c0-.2.1-.3.1-.4.5-1.6 1.1-3.2 1.6-4.8.1-.3.2-.4.5-.4h25.2c.5 0 1.1.1 1.6.2 1.4.5 2.2 1.5 2.5 2.9 0 .1.1.2.1.3v1.2z" />
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Dash <span class="small text-success">+0.17 <i class="fa fa-level-up"></i></span></p>
                            <h6 class="mb-0 fw-bold">0.000242 XRP</h6>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 65">
                              <g xmlns="http://www.w3.org/2000/svg" fill="none" fill-rule="nonzero">
                                <circle cx="31.7" cy="32.4" r="31.7" fill="#00B346" />
                                <path fill="#FEFEFE" d="M36.7 19.3c-3.6-1.1-7.2-1.9-10.9-2.8-2.5-.6-2.5-.6-3.2 2-.4 1.3-.2 1.8 1.2 2.1 2 .4 2.4 1 1.9 3.1l-1.2 4.8c-.2.7-.5.9-1.1.7-1.3-.4-2.6-.6-3.9-1-1.2-.4-1.5 0-1.7 1.1 0 .2-.1.5-.2.7-.3.8-.1 1.2.8 1.4 1.4.3 2.8.7 4.2 1 .5.1.8.2.6.9-.6 2.3-1.2 4.6-1.8 7-.3 1-1 1.4-2.1 1.2-2.5-.4-2.5-.4-3.1 2.1 0 .2 0 .4-.1.6-.4.8.1 1 .7 1.2 4.1 1 8.1 2.1 12.2 3 8.2 1.7 14.8-2.2 17.3-10.1.5-1.7.8-3.4.8-5.2.2-6.8-3.6-11.8-10.4-13.8zm-.6 22.9c-2.1 2.1-5.6 2.6-8.2 1.4-.7-.3-.9-.7-.7-1.4.6-2.5 1.2-4.9 1.8-7.4.2-.7.4-.8 1.1-.6 1.4.4 2.8.6 4.2 1.1.7.2 1 0 1.1-.6.6-2.9 1-2.2-1.6-2.9-.1 0-.3-.1-.4-.1-3.4-.8-3.4-.8-2.6-4.2.3-1.3.7-2.6 1-3.9.2-.8.4-1 1.3-.8 5 1.3 7.2 4.1 7.2 9.8-.1 3.2-1.3 6.8-4.2 9.6z" />
                              </g>
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Devcoin <span class="small text-success">+0.47 <i class="fa fa-level-up"></i></span></p>
                            <h6 class="mb-0 fw-bold">0.00002298</h6>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 65">
                              <path fill="silver" d="M32.2 64.1C14.6 64 .5 49.9.6 32.4.6 14.8 14.9.7 32.4.8 50 .9 64.1 15.1 64 32.6c-.2 17.5-14.4 31.6-31.8 31.5zm28.7-31.6c0-15.9-12.8-28.7-28.7-28.7-15.8 0-28.6 12.8-28.6 28.6 0 15.9 12.8 28.7 28.7 28.7 15.8 0 28.6-12.8 28.6-28.6z" />
                              <path fill="silver" d="M56.6 32.5C56.4 46 45.5 56.9 32.1 56.8 18.5 56.6 7.7 45.6 7.9 32.2 8.1 18.7 19 8 32.3 8.1c13.5.1 24.3 11 24.3 24.4zm-25.9 8.7v-.3c.7-2.7 1.3-5.3 2-8 .1-.2.3-.5.6-.6.7-.3 1.4-.6 2.1-.8 1.6-.4 2.5-1.3 2.7-2.9.1-.7.4-1.4.6-2.2-1.7.7-3.2 1.3-4.8 1.9C35 24 36 20 37.1 15.8H28c-.6 0-.8.2-1 .8l-4.2 15.6c-.1.3-.4.6-.6.7-.9.4-1.9.7-2.8 1.1-.2.1-.5.2-.5.3-.4 1.3-.8 2.7-1.3 4.2 1.4-.6 2.6-1.1 4-1.6-.9 3.5-1.8 6.9-2.7 10.3h25.8c.5 0 .7-.1.8-.6.2-1 .5-2 .8-2.9.2-.7.3-1.4.5-2.2l-16.1-.3z" />
                              <path fill="#FFF" d="M30.7 41.2c5.4.1 10.7.2 16.1.4-.2.8-.4 1.5-.5 2.2-.3 1-.6 1.9-.8 2.9-.1.5-.3.6-.8.6H18.9c.9-3.5 1.8-6.8 2.7-10.3-1.4.5-2.6 1-4 1.6.4-1.5.8-2.8 1.3-4.2 0-.2.3-.3.5-.3.9-.4 1.9-.7 2.8-1.1.3-.1.6-.4.6-.7L27 16.7c.1-.6.3-.8 1-.8h9.1C36 20 35 24.1 33.9 28.4c1.6-.7 3.1-1.3 4.8-1.9-.2.8-.5 1.5-.6 2.2-.2 1.6-1.1 2.5-2.7 2.9-.7.2-1.4.5-2.1.8-.2.1-.5.4-.6.6-.7 2.7-1.4 5.3-2 8v.2z" />
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Litecoin <span class="small text-danger">+0.66 <i class="fa fa-level-down"></i></span></p>
                            <h6 class="mb-0 fw-bold">0.000242 LTC</h6>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 65">
                              <path fill="#4C4C4C" d="M58.1 49.2H45.6V32L31.7 45.9 17.8 32v17.2H4.9c5.6 8.9 15.5 14.9 26.8 14.9s21.2-5.9 26.8-14.9h-.4z" />
                              <path fill="#FF6B01" d="M11.2 42.6V16.2l20.5 20.5 20.5-20.5v26.4h9.5c1.1-3.2 1.7-6.6 1.7-10.2C63.4 14.9 49.2.7 31.7.7S0 14.9 0 32.4c0 3.6.6 7 1.7 10.2h9.5z" />
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Monero <span class="small text-success">+0.33 <i class="fa fa-level-up"></i></span></p>
                            <h6 class="mb-0 fw-bold">$214.28</h6>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 65">
                              <g xmlns="http://www.w3.org/2000/svg" fill="none" fill-rule="nonzero">
                                <circle cx="32.2" cy="31.8" r="31.7" fill="#00B346" />
                                <path fill="#FFF" d="M39.8 48c13.1-11.3 5.4-31.9-21.5-32.5.3 18.2-2.2 32.2 16.1 32.2 5.7-8.7 1.5-17.3-7.8-25.8 9.2 3.6 17 14.6 13.2 26.1z" />
                              </g>
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Peercoin <span class="small text-danger">+0.11 <i class="fa fa-level-down"></i></span></p>
                            <h6 class="mb-0 fw-bold">$0.4472</h6>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 65">
                              <g xmlns="http://www.w3.org/2000/svg" fill="none" fill-rule="nonzero">
                                <circle cx="32" cy="32.4" r="31.7" fill="#739BEE" />
                                <path fill="#FEFEFE" d="M40.7 35.8c-1-.3-2-.4-2.9-.4-.9.1-1.9-.3-2.4-1.1l-.3-.4c-.6-.9-.6-2 0-2.9l.3-.5c.5-.7 1.3-1.1 2.2-1.1 1.1 0 2.2-.2 3.3-.8 2.7-1.4 4.5-4.1 4.4-7.1-.1-4.3-3.7-7.7-8.1-7.5-3.7.2-6.8 3.2-7.2 6.9-.2 2 .4 3.8 1.4 5.3.6.9.6 2.1 0 3l-.1.1c-.5.7-1.3 1.1-2.1 1.1h-.5c-1 0-1.9-.6-2.3-1.5-1.3-2.6-4-4.3-7.1-4.2-4 .1-7.3 3.4-7.4 7.4-.2 4.4 3.3 8 7.7 8 3 0 5.6-1.7 6.8-4.2.4-.9 1.3-1.5 2.3-1.5h.4c.9 0 1.7.4 2.1 1.1l.5.7c.6.8.5 1.9 0 2.7-.9 1.4-1.3 3-1.1 4.8.3 3.6 3.3 6.5 6.8 6.9 4.9.5 8.9-3.6 8.5-8.4-.2-2.9-2.3-5.5-5.2-6.4z" />
                              </g>
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Ripple <span class="small text-success">+0.56 <i class="fa fa-level-up"></i></span></p>
                            <h6 class="mb-0 fw-bold">0.000242 XRP</h6>
                          </div>
                        </div>
                        <div class="item card">
                          <div class="card-body">
                            <svg class="mb-4" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 65">
                              <g xmlns="http://www.w3.org/2000/svg" fill="none" fill-rule="nonzero">
                                <circle cx="31.7" cy="31.8" r="31.7" fill="#004F9E" />
                                <g fill="#27A1F8" transform="translate(15 14)">
                                  <path d="M33 24.9c-.3.1-.3.4-.4.6-1.1 2.2-2.7 3.9-4.5 5.4-.1.1-.3.3-.6.2-.2-.7.2-1.3.4-1.9.8-2.2.5-4.3-.5-6.4-1.4-2.8-2.8-5.7-4-8.6-.4-1-.7-1.9-.9-3-.4-1.8.5-3.2 1.6-4.5.7-.8 1.4-1.5 2.3-2.1.2-.1.4-.4.6-.2.2.1.1.4.1.7-.2 1.6-.4 3.2 0 4.7.3 1.4 1.1 2.6 1.7 3.9 1.4 3 3 5.9 4 9.1.2.5.1 1.1.4 1.5-.2.2-.2.4-.2.6zM15.9 1.7c-.1.8-.3 1.6-.3 2.4-.2 2.5.5 4.7 1.6 6.9 1.8 3.8 3.8 7.6 5.3 11.5.4 1 .7 2.1.9 3.1.3 1.7-.7 2.9-1.6 4.1-1.2 1.7-2.6 3.2-4.2 4.5-.3.2-.6.5-.9.3-.3-.2-.1-.6 0-1 .4-1.2.7-2.5.9-3.8.4-2.3-.6-4.3-1.5-6.3-1.6-3.4-3.3-6.8-4.8-10.2-.6-1.3-.9-2.6-1.2-4-.4-1.9.4-3.5 1.6-5 1-1.3 2.1-2.5 3.4-3.4.2-.2.4-.5.8-.3.1.5-.1.9 0 1.2zM5.7 31.1c-.1-.4 0-.8.1-1.2 1-2.6.7-5-.5-7.5-1.4-2.7-2.8-5.5-3.9-8.3-.3-.8-.5-1.6-.8-2.5-.4-1.3-.1-2.5.6-3.6 1-1.5 2.2-2.8 3.8-3.8.1 1.2-.2 2.2-.2 3.2 0 1.5.2 2.8.9 4.2 1.3 2.6 2.5 5.3 3.7 7.9.6 1.2 1 2.5 1.4 3.8.2.7.2 1.4-.1 2.1-1.1 2.2-2.7 4-4.6 5.5-.1.2-.3.2-.4.2z" />
                                </g>
                              </g>
                            </svg>
                            <p class="small text-uppercase mb-1 text-muted">Steem <span class="small text-success">+0.27 <i class="fa fa-level-up"></i></span></p>
                            <h6 class="mb-0 fw-bold">$0.3677</h6>
                          </div>
                        </div>
                      </div>
                      <script src="./assets/js/bundle/owlcarousel.bundle.js"></script>
                      <script>
                        $('#live_coins').owlCarousel({
                          margin: 10,
                          items: 10,
                          loop: true,
                          dots: false,
                          autoplay: true,
                          autoWidth: true,
                          autoplayHoverPause: true,
                          autoplayTimeout: 2000,
                          //slideTransition: 'linear',
                          //autoplayTimeout: 6500,
                          //autoplaySpeed: 6500,
                          responsive: {
                            0: {
                              items: 1
                            },
                            800: {
                              items: 2
                            },
                            1000: {
                              items: 3
                            },
                            1300: {
                              items: 4
                            },
                            1700: {
                              items: 5
                            },
                          }
                        })
                      </script>
                    </div>
                    <!-- tab content:: Recently -->
                    <div class="tab3 rounded-4">
                      <div class="carousel vertical slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <div class="row g-2">
                              <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                  <h6 class="mb-0 text-white">Assigned Tasks</h6>
                                  <a class="text-decoration-underline text-secondary small" href="app-tasks.html">View</a>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="card">
                                  <div class="card-body">
                                    <p class="small text-uppercase mb-2 text-muted">Pending</p>
                                    <h5 class="mb-0">102</h5>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="card">
                                  <div class="card-body">
                                    <p class="small text-uppercase mb-2 text-muted">Completed</p>
                                    <h5 class="mb-0">223</h5>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="card">
                                  <div class="card-body">
                                    <p class="small text-uppercase mb-2 text-muted">On Hold</p>
                                    <h5 class="mb-0">18</h5>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="card">
                                  <div class="card-body">
                                    <p class="small text-uppercase mb-2 text-muted">In Progress</p>
                                    <h5 class="mb-0">21</h5>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="carousel-item">
                            <div class="row g-2">
                              <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                  <h6 class="mb-0 text-white">Customer Orders</h6>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="card">
                                  <div class="card-body">
                                    <p class="small text-uppercase mb-2 text-muted">In Process</p>
                                    <h5 class="mb-0">102</h5>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="card">
                                  <div class="card-body">
                                    <p class="small text-uppercase mb-2 text-muted">Delivered</p>
                                    <h5 class="mb-0">223</h5>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="card">
                                  <div class="card-body">
                                    <p class="small text-uppercase mb-2 text-muted">On Hold</p>
                                    <h5 class="mb-0">18</h5>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="card">
                                  <div class="card-body">
                                    <p class="small text-uppercase mb-2 text-muted">In Progress</p>
                                    <h5 class="mb-0">21</h5>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
              <div class="col-xxl-3 col-xl-4 col-lg-12 d-none d-xl-inline-flex">
                <img class="img-fluid mx-3" src="./assets/img/hero-img.svg" alt="img" />
              </div>
            </div> <!-- row:: End -->
          </div>
        </div>
        <!-- Start:: main page body area -->
        <div class="page-body">
          <div class="container-fluid">
            <div class="row g-xl-4 g-lg-3 g-2 row-deck">
              <div class="col-xxl-8 col-xl-12 col-lg-12">
                <div class="card shadow-sm">
                  <div class="card-header">
                    <h6 class="card-title m-0">AVIO Revenue</h6>
                    <div class="dropdown morphing scale-left">
                      <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                      <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu shadow border-0 p-2">
                        <li><a class="dropdown-item" href="#">File Info</a></li>
                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                        <li><a class="dropdown-item" href="#">Move to</a></li>
                        <li><a class="dropdown-item" href="#">Rename</a></li>
                        <li><a class="dropdown-item" href="#">Block</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="apex-AudienceOverview"></div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                <div class="card shadow-sm">
                  <div class="card-header">
                    <h6 class="card-title mb-0">Sales by Category</h6>
                    <div class="dropdown morphing scale-left">
                      <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                      <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu shadow border-0 p-2">
                        <li><a class="dropdown-item" href="#">File Info</a></li>
                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                        <li><a class="dropdown-item" href="#">Move to</a></li>
                        <li><a class="dropdown-item" href="#">Rename</a></li>
                        <li><a class="dropdown-item" href="#">Block</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="apex-SalesbyCategory"></div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h6 class="card-title mb-0">My Wallet</h6>
                    <div class="dropdown morphing scale-left">
                      <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                      <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu shadow border-0 p-2">
                        <li><a class="dropdown-item" href="#">File Info</a></li>
                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                        <li><a class="dropdown-item" href="#">Move to</a></li>
                        <li><a class="dropdown-item" href="#">Rename</a></li>
                        <li><a class="dropdown-item" href="#">Block</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body">
                    <div>Available BTC</div>
                    <h3>0.0386245 BTC</h3>
                    <div class="py-4">
                      <div class="text-uppercase text-muted small">Buy this month</div>
                      <h5>3.0675432 BTC</h5>
                      <div class="mt-3 text-uppercase text-muted small">Sell this month</div>
                      <h5>2.0345618 BTC</h5>
                    </div>
                    <div class="btn-group d-flex">
                      <input type="radio" class="btn-check" name="gm-btnradio" id="gm-btnradio1" checked="">
                      <label class="btn btn-outline-secondary" for="gm-btnradio1">Buy</label>
                      <input type="radio" class="btn-check" name="gm-btnradio" id="gm-btnradio2">
                      <label class="btn btn-outline-secondary" for="gm-btnradio2">Sell</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h6 class="card-title mb-0">Downloads</h6>
                    <div class="dropdown morphing scale-left">
                      <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                      <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu shadow border-0 p-2">
                        <li><a class="dropdown-item" href="#">File Info</a></li>
                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                        <li><a class="dropdown-item" href="#">Move to</a></li>
                        <li><a class="dropdown-item" href="#">Rename</a></li>
                        <li><a class="dropdown-item" href="#">Block</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li class="d-flex py-2 mb-2">
                        <div class="avatar rounded no-thumbnail"><i class="fa fa-file-zip-o fa-lg"></i></div>
                        <div class="flex-fill ms-3">
                          <span>AVIO_admin.zip</span>
                          <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 44%;" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </li>
                      <li class="d-flex py-2 mb-2">
                        <div class="avatar rounded no-thumbnail"><i class="fa fa-file-pdf-o fa-lg"></i></div>
                        <div class="flex-fill ms-3">
                          <span>reposrt_2020.pdf</span>
                          <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </li>
                      <li class="d-flex py-2 mb-2">
                        <div class="avatar rounded no-thumbnail"><i class="fa fa-file-code-o fa-lg"></i></div>
                        <div class="flex-fill ms-3">
                          <span>package.json</span>
                          <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </li>
                      <li class="d-flex py-2 mb-2">
                        <div class="avatar rounded no-thumbnail"><i class="fa fa-file-code-o fa-lg"></i></div>
                        <div class="flex-fill ms-3">
                          <span>bootstrap.min.css</span>
                          <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 89%;" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <small class="text-muted">Showing 4 out of 24 downloads.</small>
                  </div>
                </div>
              </div>
              <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h6 class="card-title m-0">Reports overview</h6>
                    <div class="dropdown morphing scale-left">
                      <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                      <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu shadow border-0 p-2">
                        <li><a class="dropdown-item" href="#">File Info</a></li>
                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                        <li><a class="dropdown-item" href="#">Move to</a></li>
                        <li><a class="dropdown-item" href="#">Rename</a></li>
                        <li><a class="dropdown-item" href="#">Block</a></li>
                        <li><a class="dropdown-item" href="#">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body">
                    <h3>$7,431.14 USD</h3>
                    <!-- Progress -->
                    <div class="progress rounded-pill mb-2" style="height: 5px;">
                      <div class="progress-bar chart-color1" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar chart-color2" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                      <div class="progress-bar chart-color3" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                      <span>0%</span>
                      <span>100%</span>
                    </div>
                    <!-- End Progress -->
                    <div class="table-responsive">
                      <table class="table table-sm table-nowrap mb-0">
                        <tbody>
                          <tr>
                            <td><i class="fa fa-circle me-2 chart-text-color1"></i>Gross value</td>
                            <td>$3,500.71</td>
                            <td><span class="badge bg-success">+12.1%</span></td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle me-2 chart-text-color2"></i>Net volume from sales</td>
                            <td>$2,980.45</td>
                            <td><span class="badge bg-warning">+6.9%</span></td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle me-2 chart-text-color3"></i>New volume from sales</td>
                            <td>$950.00</td>
                            <td><span class="badge bg-danger">-1.5%</span></td>
                          </tr>
                          <tr>
                            <td><i class="fa fa-circle me-2"></i>Other</td>
                            <td>32</td>
                            <td><span class="badge bg-success">1.9%</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- .row end -->
          </div>
        </div>
        <!-- Start:: footer link and more -->
        <div class="page-footer bg-card mt-4">
          <div class="container-fluid">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-2">
              <p class="col-md-5 mb-0 text-muted">© 2022 <a href="javascript:void(0)">AVIO</a>. <span class="fa fa-heart text-danger"></span> by <a href="javascript:void(0)"> ThemeMakker </a></p>
              <ul class="nav col-md-7 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Support</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Purchase</a></li>
              </ul>
            </footer>
          </div>
        </div>
      </div>
      <!-- Modal: Create project -->
      <div class="modal fade" id="create_project" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Setup new project</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom_scroll">
              <ul class="nav nav-tabs tab-card px-0" role="tablist">
                <li class="nav-item flex-fill text-center"><a class="nav-link active" href="#step1" data-bs-toggle="tab" data-bs-step="1">1. Project</a></li>
                <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step2" data-bs-toggle="tab" data-bs-step="2">2. Details</a></li>
                <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step3" data-bs-toggle="tab" data-bs-step="3">3. Team</a></li>
                <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step4" data-bs-toggle="tab" data-bs-step="4">4. File</a></li>
                <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step5" data-bs-toggle="tab" data-bs-step="5">5. Completed</a></li>
              </ul>
              <!-- start: project status progress bar -->
              <div class="progress bg-transparent" style="height: 3px; margin-top: -2px;">
                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 20%;"></div>
              </div>
              <div class="tab-content mt-3">
                <!-- start: project type -->
                <div class="tab-pane fade show active" id="step1">
                  <div class="card bg-body mb-2">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Project Type</h6>
                      <p class="text-muted small">If you need more info, please check out <a href="#">FAQ Page</a></p>
                      <!-- Custome redio input -->
                      <div class="c_radio d-flex flex-md-wrap">
                        <label class="m-1 w-100" for="Personal">
                          <input type="radio" name="plan" id="Personal" checked />
                          <span class="card">
                            <span class="card-body d-flex p-3">
                              <svg class="avatar" viewBox="0 0 16 16">
                                <path class="fill-muted" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                              </svg>
                              <span class="ms-3">
                                <span class="h6 d-flex mb-1">Personal Project</span>
                                <span class="text-muted">For smaller business, with simple salaries and pay schedules.</span>
                              </span>
                            </span>
                          </span>
                        </label>
                        <label class="m-1 w-100" for="Team">
                          <input type="radio" name="plan" id="Team" />
                          <span class="card">
                            <span class="card-body d-flex p-3">
                              <svg class="avatar" viewBox="0 0 16 16">
                                <path class="fill-muted" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                <path class="fill-muted" fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                <path class="fill-muted" d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                              </svg>
                              <span class="ms-3">
                                <span class="h6 d-flex mb-1">Team Project</span>
                                <span class="text-muted">For growing business who wants to create a rewarding place to work.</span>
                              </span>
                            </span>
                          </span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn bg-secondary text-light next text-uppercase">Add project details</button>
                  </div>
                </div>
                <!-- start: project detail -->
                <div class="tab-pane fade" id="step2">
                  <div class="card bg-body mb-2">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Project Details</h6>
                      <p class="text-muted small">It is a long established fact that a reader will be distracted by Avio.</p>
                      <div class="form-floating mb-2">
                        <select class="form-select">
                          <option selected>Open this select menu</option>
                          <option value="1">Lucid</option>
                          <option value="2">AVIO</option>
                          <option value="3">Avio</option>
                        </select>
                        <label>Choose a Customer *</label>
                      </div>
                      <div class="form-floating mb-2">
                        <input type="text" class="form-control" placeholder="Project name">
                        <label>Project name *</label>
                      </div>
                      <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Add project details" style="height: 100px"></textarea>
                        <label>Add project details</label>
                      </div>
                      <div class="form-floating mb-4">
                        <input type="date" class="form-control">
                        <label>Enter release Date *</label>
                      </div>
                      <div class="d-flex justify-content-between">
                        <div class="text-muted">Allow Notifications *</div>
                        <div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="allow_phone" value="option1">
                            <label class="form-check-label" for="allow_phone">Phone</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="allow_email" value="option2">
                            <label class="form-check-label" for="allow_email">Email</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn bg-secondary text-light next text-uppercase">Select project team</button>
                  </div>
                </div>
                <!-- start: select team -->
                <div class="tab-pane fade" id="step3">
                  <div class="card bg-body mb-2">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Build a Team</h6>
                      <p class="text-muted small">If you need more info, please check out <a href="#">Project Guidelines</a></p>
                      <div class="form-floating mb-4">
                        <input type="text" class="form-control" placeholder="Invite Teammates">
                        <label>Invite Teammates</label>
                      </div>
                      <h6 class="card-title mb-1">Team Members</h6>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="list-group6" checked="">
                        <label class="form-check-label text-muted" for="list-group6">Adding Users by Team Members</label>
                      </div>
                      <ul class="list-group list-group-flush list-group-custom custom_scroll mb-0 mt-4" style="height: 300px;">
                        <li class="list-group-item d-flex align-items-center">
                          <img class="avatar rounded" src="./assets/img/xs/avatar1.jpg" alt="">
                          <div class="flex-fill ms-2">
                            <div class="h6 mb-0">Chris Fox</div>
                            <small class="text-muted">Angular Developer</small>
                          </div>
                          <select class="form-select  form-select-sm w120">
                            <option value="1">Owner</option>
                            <option value="2">Can Edit</option>
                            <option value="3">Guest</option>
                          </select>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                          <img class="avatar rounded" src="./assets/img/xs/avatar2.jpg" alt="">
                          <div class="flex-fill ms-2">
                            <div class="h6 mb-0">Joge Lucky</div>
                            <small class="text-muted">ReactJs Developer</small>
                          </div>
                          <select class="form-select  form-select-sm w120">
                            <option value="1">Owner</option>
                            <option value="2">Can Edit</option>
                            <option value="3">Guest</option>
                          </select>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                          <img class="avatar rounded" src="./assets/img/xs/avatar3.jpg" alt="">
                          <div class="flex-fill ms-2">
                            <div class="h6 mb-0">Chris Fox</div>
                            <small class="text-muted">NodeJs Developer</small>
                          </div>
                          <select class="form-select  form-select-sm w120">
                            <option value="1">Owner</option>
                            <option value="2">Can Edit</option>
                            <option value="3">Guest</option>
                          </select>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                          <img class="avatar rounded" src="./assets/img/xs/avatar4.jpg" alt="">
                          <div class="flex-fill ms-2">
                            <div class="h6 mb-0">Chris Fox</div>
                            <small class="text-muted">Sr. Designer</small>
                          </div>
                          <select class="form-select  form-select-sm w120">
                            <option value="1">Owner</option>
                            <option value="2">Can Edit</option>
                            <option value="3">Guest</option>
                          </select>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                          <img class="avatar rounded" src="./assets/img/xs/avatar5.jpg" alt="">
                          <div class="flex-fill ms-2">
                            <div class="h6 mb-0">Chris Fox</div>
                            <small class="text-muted">Designer</small>
                          </div>
                          <select class="form-select  form-select-sm w120">
                            <option value="1">Owner</option>
                            <option value="2">Can Edit</option>
                            <option value="3">Guest</option>
                          </select>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                          <img class="avatar rounded" src="./assets/img/xs/avatar6.jpg" alt="">
                          <div class="flex-fill ms-2">
                            <div class="h6 mb-0">Chris Fox</div>
                            <small class="text-muted">Front-End Developer</small>
                          </div>
                          <select class="form-select  form-select-sm w120">
                            <option value="1">Owner</option>
                            <option value="2">Can Edit</option>
                            <option value="3">Guest</option>
                          </select>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                          <img class="avatar rounded" src="./assets/img/xs/avatar7.jpg" alt="">
                          <div class="flex-fill ms-2">
                            <div class="h6 mb-0">Chris Fox</div>
                            <small class="text-muted">QA</small>
                          </div>
                          <select class="form-select  form-select-sm w120">
                            <option value="1">Owner</option>
                            <option value="2">Can Edit</option>
                            <option value="3">Guest</option>
                          </select>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                          <img class="avatar rounded" src="./assets/img/xs/avatar8.jpg" alt="">
                          <div class="flex-fill ms-2">
                            <div class="h6 mb-0">Chris Fox</div>
                            <small class="text-muted">Laravel Developer</small>
                          </div>
                          <select class="form-select  form-select-sm w120">
                            <option value="1">Owner</option>
                            <option value="2">Can Edit</option>
                            <option value="3">Guest</option>
                          </select>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn bg-secondary text-light next text-uppercase">Upload Files</button>
                  </div>
                </div>
                <!-- start: Upload Files -->
                <div class="tab-pane fade" id="step4">
                  <div class="card bg-body mb-2">
                    <div class="card-body">
                      <h6 class="card-title mb-1">Upload Files</h6>
                      <div class="mb-4">
                        <label class="form-label small">Upload up to 10 files</label>
                        <input class="form-control" type="file" multiple>
                      </div>
                      <span>Already Uploaded File</span>
                      <ul class="list-group list-group-flush list-group-custom custom_scroll mb-0 mt-4" style="height: 300px;">
                        <li class="list-group-item py-3">
                          <div class="d-flex align-items-center">
                            <div class="avatar rounded no-thumbnail"><i class="fa fa-file-pdf-o text-danger"></i></div>
                            <div class="flex-fill ms-3 text-truncate">
                              <p class="mb-0 color-800">Annual Sales Report 2018-19</p>
                              <small class="text-muted">.pdf, 5.3 MB</small>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item py-3">
                          <div class="d-flex align-items-center">
                            <div class="avatar rounded no-thumbnail"><i class="fa fa-file-excel-o text-success"></i></div>
                            <div class="flex-fill ms-3 text-truncate">
                              <p class="mb-0 color-800">Complete Product Sheet</p>
                              <small class="text-muted">.xls, 2.1 MB</small>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item py-3">
                          <div class="d-flex align-items-center">
                            <div class="avatar rounded no-thumbnail"><i class="fa fa-file-word-o text-info"></i></div>
                            <div class="flex-fill ms-3 text-truncate">
                              <p class="mb-0 color-800">Marketing Guidelines</p>
                              <small class="text-muted">.doc, 2.3 MB</small>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item py-3">
                          <div class="d-flex align-items-center">
                            <div class="avatar rounded no-thumbnail"><i class="fa fa-file-zip-o"></i></div>
                            <div class="flex-fill ms-3 text-truncate">
                              <p class="mb-0 color-800">Brand Photography</p>
                              <small class="text-muted">.zip, 30.5 MB</small>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn bg-secondary text-light next text-uppercase">Finish</button>
                  </div>
                </div>
                <!-- start: project setup done -->
                <div class="tab-pane fade" id="step5">
                  <div class="card bg-body text-center">
                    <div class="card-body">
                      <h4 class="card-title mb-1">Project Created!</h4>
                      <span class="text-muted">If you need more info, please check how to create project</span>
                    </div>
                    <div class="card-body">
                      <button class="btn btn-lg btn-primary first text-uppercase">Cretae new project</button>
                      <button class="btn btn-lg bg-secondary text-light text-uppercase">View project</button>
                    </div>
                    <div class="card-body">
                      <img class="img-fluid" src="./assets/img/project-team.svg" alt="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal: RecentChat -->
      <div class="modal fade" id="recent_chat" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical modal-dialog-scrollable">
          <div class="modal-content">
            <div class="d-flex align-items-start">
              <div class="nav flex-column nav-pills p-3 h-100">
                <a class="nav-link rounded-circle p-1 mb-2 active" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar1.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-2" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar2.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar3.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-2" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar4.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-5" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar5.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar6.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-7" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar7.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar8.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar9.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar10.jpg" alt="avatar">
                </a>
                <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
                  <img class="avatar sm rounded-circle border" src="./assets/img/xs/avatar5.jpg" alt="avatar">
                </a>
              </div>
              <div class="tab-content shadow-sm">
                <div class="tab-pane fade show active" id="c-user-1" role="tabpanel">
                  <div class="card">
                    <!-- start: chat header -->
                    <div class="card-header border-bottom py-3">
                      <div class="d-flex">
                        <a href="javascript:void(0);" title="">
                          <img class="avatar rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="avatar">
                        </a>
                        <div class="ms-3">
                          <h6 class="mb-0">Orlando Lentz</h6>
                          <small class="text-muted">Last seen: 2 hours ago</small>
                        </div>
                      </div>
                      <div class="dropdown morphing scale-left">
                        <a class="nav-link p-2 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-camera"></i></a>
                        <a class="nav-link p-2 me-1 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-video-camera"></i></a>
                        <a class="nav-link py-2 px-3 text-muted d-inline-block d-xl-none" data-bs-dismiss="modal" aria-label="Close" href="#"><i class="fa fa-close"></i></a>
                        <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                        <ul class="dropdown-menu shadow border-0 p-2">
                          <li><a class="dropdown-item" href="#">File Info</a></li>
                          <li><a class="dropdown-item" href="#">Copy to</a></li>
                          <li><a class="dropdown-item" href="#">Move to</a></li>
                          <li><a class="dropdown-item" href="#">Rename</a></li>
                          <li><a class="dropdown-item" href="#">Block</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- start: chat body -->
                    <div class="card-body custom_scroll" style="height: calc(100vh - 141px);">
                      <ul class="list-unstyled chat-history flex-grow-1">
                        <!-- Chat: left -->
                        <li class="mb-3 d-flex flex-row align-items-end">
                          <div class="max-width-70">
                            <div class="user-info mb-1">
                              <img class="avatar xs rounded-circle me-1" src="./assets/img/xs/avatar1.jpg" alt="avatar">
                              <span class="text-muted small">10:10 AM, Today</span>
                            </div>
                            <div class="card p-3">
                              <div class="message"> Hi Aiden, how are you?</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: right -->
                        <li class="mb-3 d-flex flex-row-reverse align-items-end">
                          <div class="max-width-70 text-end">
                            <div class="user-info mb-1">
                              <span class="text-muted small">10:12 AM, Today</span>
                            </div>
                            <div class="card border-0 p-3 bg-primary text-light">
                              <div class="message">Are we meeting today?</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: left -->
                        <li class="mb-3 d-flex flex-row align-items-end">
                          <div class="max-width-70">
                            <div class="user-info mb-1">
                              <img class="avatar xs rounded-circle me-1" src="./assets/img/xs/avatar1.jpg" alt="avatar">
                              <span class="text-muted small">10:10 AM, Today</span>
                            </div>
                            <div class="card p-3">
                              <div class="message"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: left -->
                        <li class="mb-3 d-flex flex-row align-items-end">
                          <div class="max-width-70">
                            <div class="user-info mb-1">
                              <img class="avatar xs rounded-circle me-1" src="./assets/img/xs/avatar1.jpg" alt="avatar">
                              <span class="text-muted small">10:10 AM, Today</span>
                            </div>
                            <div class="card p-3">
                              <div class="message"> Contrary to popular belief, Lorem Ipsum is not simply random text.</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: right -->
                        <li class="mb-3 d-flex flex-row-reverse align-items-end">
                          <div class="max-width-70 text-end">
                            <div class="user-info mb-1">
                              <span class="text-muted small">10:12 AM, Today</span>
                            </div>
                            <div class="card border-0 p-3 bg-primary text-light">
                              <div class="message">Yes, Orlando Allredy done <br> There are many variations of passages of Lorem Ipsum available</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: left -->
                        <li class="mb-3 d-flex flex-row align-items-end">
                          <div class="max-width-70">
                            <div class="user-info mb-1">
                              <img class="avatar xs rounded-circle me-1" src="./assets/img/xs/avatar1.jpg" alt="avatar">
                              <span class="text-muted small">10:10 AM, Today</span>
                            </div>
                            <div class="card p-3">
                              <div class="message">
                                <p>Please find attached images</p>
                                <img class="w120 img-thumbnail" src="./assets/img/gallery/3.jpg" alt="">
                                <img class="w120 img-thumbnail" src="./assets/img/gallery/4.jpg" alt="">
                              </div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: right -->
                        <li class="mb-3 d-flex flex-row-reverse align-items-end">
                          <div class="max-width-70 text-end">
                            <div class="user-info mb-1">
                              <span class="text-muted small">10:12 AM, Today</span>
                            </div>
                            <div class="card border-0 p-3 bg-primary text-light">
                              <div class="message">Okay, will check and let you know.</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!-- start: chat footer -->
                    <div class="card-footer border-top bg-transparent py-3 px-4">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter text here...">
                        <button class="btn btn-primary" type="button">Send</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade show active" id="c-user-2" role="tabpanel">
                  <div class="card">
                    <!-- start: chat header -->
                    <div class="card-header border-bottom py-3">
                      <div class="d-flex">
                        <a href="javascript:void(0);" title="">
                          <img class="avatar rounded-circle" src="./assets/img/xs/avatar2.jpg" alt="avatar">
                        </a>
                        <div class="ms-3">
                          <h6 class="mb-0">Orlando Lentz</h6>
                          <small class="text-muted">Last seen: 2 hours ago</small>
                        </div>
                      </div>
                      <div class="dropdown morphing scale-left">
                        <a class="nav-link p-2 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-camera"></i></a>
                        <a class="nav-link p-2 me-1 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-video-camera"></i></a>
                        <a class="nav-link py-2 px-3 text-muted d-inline-block d-xl-none" data-bs-dismiss="modal" aria-label="Close" href="#"><i class="fa fa-close"></i></a>
                        <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                        <ul class="dropdown-menu shadow border-0 p-2">
                          <li><a class="dropdown-item" href="#">File Info</a></li>
                          <li><a class="dropdown-item" href="#">Copy to</a></li>
                          <li><a class="dropdown-item" href="#">Move to</a></li>
                          <li><a class="dropdown-item" href="#">Rename</a></li>
                          <li><a class="dropdown-item" href="#">Block</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- start: chat body -->
                    <div class="card-body custom_scroll" style="height: calc(100vh - 141px);">
                      <ul class="list-unstyled chat-history flex-grow-1">
                        <!-- Chat: right -->
                        <li class="mb-3 d-flex flex-row-reverse align-items-end">
                          <div class="max-width-70 text-end">
                            <div class="user-info mb-1">
                              <span class="text-muted small">10:12 AM, Today</span>
                            </div>
                            <div class="card border-0 p-3 bg-primary text-light">
                              <div class="message">Are we meeting today?</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: left -->
                        <li class="mb-3 d-flex flex-row align-items-end">
                          <div class="max-width-70">
                            <div class="user-info mb-1">
                              <img class="avatar xs rounded-circle me-1" src="./assets/img/xs/avatar2.jpg" alt="avatar">
                              <span class="text-muted small">10:10 AM, Today</span>
                            </div>
                            <div class="card p-3">
                              <div class="message"> Hi Aiden, how are you?</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: right -->
                        <li class="mb-3 d-flex flex-row-reverse align-items-end">
                          <div class="max-width-70 text-end">
                            <div class="user-info mb-1">
                              <span class="text-muted small">10:12 AM, Today</span>
                            </div>
                            <div class="card border-0 p-3 bg-primary text-light">
                              <div class="message">Yes, Orlando Allredy done <br> There are many variations of passages of Lorem Ipsum available</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: left -->
                        <li class="mb-3 d-flex flex-row align-items-end">
                          <div class="max-width-70">
                            <div class="user-info mb-1">
                              <img class="avatar xs rounded-circle me-1" src="./assets/img/xs/avatar2.jpg" alt="avatar">
                              <span class="text-muted small">10:10 AM, Today</span>
                            </div>
                            <div class="card p-3">
                              <div class="message">
                                <p>Please find attached images</p>
                                <img class="w120 img-thumbnail" src="./assets/img/gallery/1.jpg" alt="">
                                <img class="w120 img-thumbnail" src="./assets/img/gallery/2.jpg" alt="">
                              </div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: right -->
                        <li class="mb-3 d-flex flex-row-reverse align-items-end">
                          <div class="max-width-70 text-end">
                            <div class="user-info mb-1">
                              <span class="text-muted small">10:12 AM, Today</span>
                            </div>
                            <div class="card border-0 p-3 bg-primary text-light">
                              <div class="message">Okay, will check and let you know.</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: left -->
                        <li class="mb-3 d-flex flex-row align-items-end">
                          <div class="max-width-70">
                            <div class="user-info mb-1">
                              <img class="avatar xs rounded-circle me-1" src="./assets/img/xs/avatar2.jpg" alt="avatar">
                              <span class="text-muted small">10:10 AM, Today</span>
                            </div>
                            <div class="card p-3">
                              <div class="message"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                        <!-- Chat: left -->
                        <li class="mb-3 d-flex flex-row align-items-end">
                          <div class="max-width-70">
                            <div class="user-info mb-1">
                              <img class="avatar xs rounded-circle me-1" src="./assets/img/xs/avatar2.jpg" alt="avatar">
                              <span class="text-muted small">10:10 AM, Today</span>
                            </div>
                            <div class="card p-3">
                              <div class="message"> Contrary to popular belief, Lorem Ipsum is not simply random text.</div>
                            </div>
                          </div>
                          <!-- More option -->
                          <div class="btn-group">
                            <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <ul class="dropdown-menu rounded-4 border-0 shadow">
                              <li><a class="dropdown-item" href="#">Edit</a></li>
                              <li><a class="dropdown-item" href="#">Share</a></li>
                              <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!-- start: chat footer -->
                    <div class="card-footer border-top bg-transparent py-3 px-4">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter text here...">
                        <button class="btn btn-primary" type="button">Send</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal: Setting -->
      <div class="modal fade" id="SettingsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical right-side modal-dialog-scrollable">
          <div class="modal-content">
            <div class="px-xl-4 modal-header">
              <h5 class="modal-title">Theme Setting</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="px-xl-4 modal-body custom_scroll">
              <!-- start: color setting -->
              <div class="card fieldset border border-primary p-3 setting-theme mb-4">
                <span class="fieldset-tile text-primary bg-card">Color Settings</span>
                <ul class="list-unstyled d-flex choose-skin mb-0">
                  <li data-theme="black">
                    <div class="black"></div>
                  </li>
                  <li data-theme="indigo">
                    <div class="indigo"></div>
                  </li>
                  <li data-theme="blue">
                    <div class="blue"></div>
                  </li>
                  <li data-theme="cyan">
                    <div class="cyan"></div>
                  </li>
                  <li data-theme="green">
                    <div class="green"></div>
                  </li>
                  <li data-theme="orange">
                    <div class="orange"></div>
                  </li>
                  <li data-theme="blush">
                    <div class="blush"></div>
                  </li>
                  <li data-theme="red">
                    <div class="red"></div>
                  </li>
                  <li data-theme="dynamic">
                    <div class="dynamic"><i class="fa fa-paint-brush"></i></div>
                  </li>
                </ul>
                <!-- Settings: Theme dynamics -->
                <div class="card fieldset border border-primary p-3 dt-setting mt-4">
                  <span class="fieldset-tile text-primary bg-card">Dynamic Color Settings</span>
                  <div class="row g-3">
                    <div class="col-7">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <button id="primaryColorPicker" class="btn bg-primary avatar xs me-2"></button>
                          <label>Primary Color</label>
                        </li>
                        <li>
                          <button id="secondaryColorPicker" class="btn bg-secondary avatar xs me-2"></button>
                          <label>Secondary Color</label>
                        </li>
                        <li>
                          <button id="BodyColorPicker" class="btn btn-outline-secondary bg-body avatar xs me-2"></button>
                          <label>Site Background</label>
                        </li>
                        <li>
                          <button id="CardColorPicker" class="btn btn-outline-secondary bg-card avatar xs me-2"></button>
                          <label>Widget Background</label>
                        </li>
                        <li>
                          <button id="BorderColorPicker" class="btn btn-outline-secondary bg-card avatar xs me-2"></button>
                          <label>Border Color</label>
                        </li>
                      </ul>
                    </div>
                    <div class="col-5">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <button id="chartColorPicker1" class="btn chart-color1 avatar xs me-2"></button>
                          <label>Chart Color 1</label>
                        </li>
                        <li>
                          <button id="chartColorPicker2" class="btn chart-color2 avatar xs me-2"></button>
                          <label>Chart Color 2</label>
                        </li>
                        <li>
                          <button id="chartColorPicker3" class="btn chart-color3 avatar xs me-2"></button>
                          <label>Chart Color 3</label>
                        </li>
                        <li>
                          <button id="chartColorPicker4" class="btn chart-color4 avatar xs me-2"></button>
                          <label>Chart Color 4</label>
                        </li>
                        <li>
                          <button id="chartColorPicker5" class="btn chart-color5 avatar xs me-2"></button>
                          <label>Chart Color 5</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- start: Light/dark -->
              <div class="card fieldset border setting-mode mb-4">
                <span class="fieldset-tile bg-card">Light/Dark & Contrast Layout</span>
                <div class="c_radio d-flex text-center">
                  <label class="m-1 theme-switch" for="theme-switch">
                    <input type="checkbox" id="theme-switch" />
                    <span class="card p-2">
                      <img class="img-fluid" src="./assets/img/dark-version.svg" alt="Dark Mode" />
                    </span>
                  </label>
                  <label class="m-1 theme-dark" for="theme-dark">
                    <input type="checkbox" id="theme-dark" />
                    <span class="card p-2">
                      <img class="img-fluid" src="./assets/img/dark-theme.svg" alt="Theme Dark Mode" />
                    </span>
                  </label>
                  <label class="m-1 theme-high-contrast" for="theme-high-contrast">
                    <input type="checkbox" id="theme-high-contrast" />
                    <span class="card p-2">
                      <img class="img-fluid" src="./assets/img/high-version.svg" alt="High Contrast" />
                    </span>
                  </label>
                  <label class="m-1 theme-rtl" for="theme-rtl">
                    <input type="checkbox" id="theme-rtl" />
                    <span class="card p-2">
                      <img class="img-fluid" src="./assets/img/rtl-version.svg" alt="RTL Mode!" />
                    </span>
                  </label>
                </div>
              </div>
              <!-- start: Font setting -->
              <div class="card fieldset border setting-font mb-4">
                <span class="fieldset-tile bg-card">Font Settings</span>
                <div class="c_radio d-flex text-center font_setting">
                  <label class="m-1" for="font-opensans">
                    <input type="radio" name="font" id="font-opensans" value="font-opensans" checked="" />
                    <span class="card p-2 bg-body">
                      <img class="img-fluid" src="./assets/img/font-opensans.svg" alt="Dark Mode" />
                    </span>
                  </label>
                  <label class="m-1" for="font-nunito">
                    <input type="radio" name="font" id="font-nunito" value="font-nunito" />
                    <span class="card p-2 bg-body">
                      <img class="img-fluid" src="./assets/img/font-nunito.svg" alt="Dark Mode" />
                    </span>
                  </label>
                  <label class="m-1" for="font-raleway">
                    <input type="radio" name="font" id="font-raleway" value="font-raleway" />
                    <span class="card p-2 bg-body">
                      <img class="img-fluid" src="./assets/img/font-raleway.svg" alt="Dark Mode" />
                    </span>
                  </label>
                </div>
                <!-- start: Dynamic Font Settings -->
                <div class="m-1 p-3 bg-body rounded-4">
                  <p>Dynamic Font Settings</p>
                  <div class="mb-2">
                    <label class="form-label small text-muted mb-0">Enter font URL</label>
                    <input id="font_url" type="text" class="form-control" placeholder="http://fonts.cdnfonts.com/css/vonfont">
                  </div>
                  <div class="mb-3">
                    <label class="form-label small text-muted mb-0">Enter font family name</label>
                    <input id="font_family" type="text" class="form-control" placeholder="vonfont">
                  </div>
                  <button id="font_apply" type="submit" class="btn btn-primary">Save Changes</button>
                  <button id="font_cancel" type="submit" class="btn btn-secondary">Clear Changes</button>
                </div>
              </div>
              <!-- start: Extra setting -->
              <div class="setting-more mb-4">
                <h6 class="card-title">More Setting</h6>
                <ul class="list-group list-group-flush list-group-custom fs-6">
                  <!-- Settings: Border radius -->
                  <li class="list-group-item">
                    <div class="form-check form-switch radius-switch mb-1">
                      <input class="form-check-input" type="checkbox" id="BorderRadius">
                      <label class="form-check-label" for="BorderRadius">Border Radius none</label>
                    </div>
                  </li>
                  <!-- Settings: Container Fluid -->
                  <li class="list-group-item">
                    <div class="form-check form-switch fluid-switch mb-1">
                      <input class="form-check-input" type="checkbox" id="fluidLayout" checked="">
                      <label class="form-check-label" for="fluidLayout">Container Fluid</label>
                    </div>
                  </li>
                  <!-- Settings: Card box shadow  -->
                  <li class="list-group-item">
                    <div class="form-check form-switch shadow-switch mb-1">
                      <input class="form-check-input" type="checkbox" id="card_shadow">
                      <label class="form-check-label" for="card_shadow">Card Box-Shadow</label>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="px-xl-4 modal-footer d-flex justify-content-start text-center">
              <button type="button" class="btn flex-fill btn-primary lift">Save Changes</button>
              <button type="button" class="btn flex-fill btn-white border lift" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    <script src="{{ asset('js/theme.js') }}"></script>

    <script>
        $(document).ready(function() {

            $.ajax({
                url: "#",
                method: "GET",
                beforeSend: function(response) {
                    $('.loadBox').show();
                },
                success: function(response) {
                    $('.loadBox').hide();
                    $('#web_aktif').html(response.web_aktif);
                    $('#web_tidak_aktif').html(response.web_tidak_aktif);
                    // $('#siswa').html(response.siswa);
                }
            });
        });
    </script>



</body>

</html>
