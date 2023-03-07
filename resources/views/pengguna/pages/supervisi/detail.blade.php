@extends('pengguna.layouts.app')

@section('page_header')
<div class="page-header pattern-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-2">

                @include('pengguna.layouts.partials.breadcrumb')

                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h2 mb-md-0 text-white fw-light">{{ $pageTitle }} </h1>
                    <div class="page-action">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('contents')
<!-- Start:: main page body area -->
<div class="page-body page-layout-1">
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row">
            <div class="col-12 mb-2">
                <div class="project-list d-flex flex-nowrap align-items-start">
                    <div class="order-1 sticky-lg-top shadow-sm">
                        <ul class="nav nav-tabs menu-list list-unstyled mb-0 border-0">
                            <li class="nav-item"><a class="nav-link active" href="#" data-bs-toggle="tab" data-bs-target="#pd_overview" role="tab">Overview</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#plan_activity" role="tab">Plan Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#actual_activity" role="tab">Actual Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#pd_activity" role="tab">Inventory</a></li>
                            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#pd_settings" role="tab">Administrasi</a></li>
                            <li class="divider mt-4 py-2 border-top text-uppercase text-muted"><small>Project Cost</small></li>
                            <li>
                                <h2 class="fw-normal">$8,890</h2>
                                <div class="mt-3">
                                    <div class="mb-0 fw-bold">22 Feb 2022</div>
                                    <small class="text-muted">Due Date</small>
                                </div>
                            </li>
                            <li class="divider mt-4 py-2 border-top text-uppercase text-muted"><small>Clients Detail</small></li>
                            <li>
                                <div class="circle">
                                    <img class="avatar xl rounded-circle img-thumbnail" src="./assets/img/xs/avatar1.jpg" alt="">
                                </div>
                                <h6 class="mt-3 mb-0">Michelle Green</h6>
                                <span>jason-porter@info.com</span>
                                <button class="btn btn-outline-secondary btn-sm mt-3">Message</button>
                            </li>
                        </ul>
                    </div>
                    <div class="order-2 flex-grow-1 ps-lg-3 ps-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pd_overview" role="tabpanel">
                                <div class="d-flex justify-content-between p-3 bg-card rounded-4 mb-3">
                                    <h6 class="card-title mb-0"><a class="me-2 fa fa-arrow-circle-left" href="app-project.html" title="back"></a>Project Overview</h6>
                                    <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="alert alert-success" role="alert">
                                    <h6 class="alert-heading">Project Task !</h6>

                                    <p class="mb-0">{{ ucwords($profil->task)}}</p>
                                </div>
                                <div class="row g-3 row-deck">
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="fw-bold h4 mb-2">1.5K</span>
                                                <div class="text-muted text-uppercase small">Upfront Payment</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="fw-bold h4 mb-2">3.5K</span>
                                                <div class="text-muted text-uppercase small">Invoice Sent</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="fw-bold h4 mb-2">4K</span>
                                                <div class="text-muted text-uppercase small">Payment Received</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <span class="fw-bold h4 mb-2">1.7K</span>
                                                <div class="text-muted text-uppercase small">Amount Pending</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-xl-7 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Tasks Over Time</h6>
                                                <!-- widgest: Card more action icon -->
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
                                                <div id="apex-wc-9"></div>
                                            </div>
                                        </div> <!-- .card end -->
                                    </div>
                                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Tasks Summary</h6>
                                                <!-- widgest: Card more action icon -->
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
                                            <div class="card-body text-center pt-0">
                                                <div class="d-flex">
                                                    <div class="card flex-fill me-1 px-2 py-3">
                                                        <h6 class="mb-0 fw-bold">27</h6>
                                                        <small class="text-muted">RESOLVED</small>
                                                    </div>
                                                    <div class="card flex-fill ms-1 px-2 py-3">
                                                        <h6 class="mb-0 fw-bold">13</h6>
                                                        <small class="text-muted">ISSUES</small>
                                                    </div>
                                                </div>
                                                <div class="mt-3" id="apex-wc-12"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-4 col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title">Milestones</h6>
                                                <!-- widgest: Card more action icon -->
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
                                            <div class="bg-light py-3 px-4">
                                                <span>Overall progress</span>
                                                <div class="progress mt-2" style="height: 5px;">
                                                    <div class="progress-bar bg-primary-gradient" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;"></div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <span>App Ui design</span>
                                                <div class="progress mt-2 mb-4" style="height: 5px;">
                                                    <div class="progress-bar chart-color1" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                                                </div>
                                                <span>Desktop app development</span>
                                                <div class="progress mt-2 mb-4" style="height: 5px;">
                                                    <div class="progress-bar chart-color2" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;"></div>
                                                </div>
                                                <span>Website design</span>
                                                <div class="progress mt-2 mb-4" style="height: 5px;">
                                                    <div class="progress-bar chart-color3" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                                                </div>
                                                <span>QA Analyst</span>
                                                <div class="progress mt-2" style="height: 5px;">
                                                    <div class="progress-bar chart-color4" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-7 col-lg-12 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title">Project Team</h6>
                                                <!-- widgest: Card more action icon -->
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
                                            <ul class="list-group list-group-flush list-group-custom mb-0">
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Chris Fox</div>
                                                        <small class="text-muted">Design Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar8.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Cindy Anderson</div>
                                                        <small class="text-muted">Marketing Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar4.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Maryam Amiri</div>
                                                        <small class="text-muted">Dev Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar2.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar5.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar5.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar8.jpg" alt="friend">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Alexander</div>
                                                        <small class="text-muted">QA Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar5.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar7.jpg" alt="friend">
                                                    </div>
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="avatar rounded-circle"><img class="avatar rounded-circle" src="./assets/img/xs/avatar7.jpg" alt="friend"></div>
                                                    <div class="flex-fill ms-3">
                                                        <div class="h6 mb-0">Joge Lucky</div>
                                                        <small class="text-muted">Sales Lead</small>
                                                    </div>
                                                    <div class="flex-end avatar-list">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend">
                                                        <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend">
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="plan_activity" role="tabpanel">
                                <div class="d-flex justify-content-between p-3 bg-card rounded-4 mb-3">
                                    <h6 class="card-title mb-0"><a class="me-2 fa fa-arrow-circle-left" href="#" title="back"></a>Project Plan Activity</h6>
                                    <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-12">
                                        <div id="container_plan"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="actual_activity" role="tabpanel">
                                <div class="d-flex justify-content-between p-3 bg-card rounded-4 mb-3">
                                    <h6 class="card-title mb-0"><a class="me-2 fa fa-arrow-circle-left" href="#" title="back"></a>Project Actual Activity</h6>
                                    <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-12">
                                        <div id="container_actual"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pd_activity" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Project Activity</h6>
                                        <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline-item ti-danger ms-2">
                                            <div class="d-flex">
                                                <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="">
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1 fs-6">Gerald Vaughn changed the status to QA on <a href="#" class="avio-link text_bg2">MA-86</a> - Retargeting Ads</div>
                                                    <span class="d-flex text-muted small">New Dashboard Design - 9:24PM by <a class="ms-2" href="#" title=""><strong>You</strong></a> </span>
                                                    <div class="card mt-3 p-3"> I’ve prepared all sizes for you. Can you take a look tonight so we can prepare my final invoice? </div>
                                                </div>
                                            </div>
                                        </div> <!-- timeline item end  -->
                                        <div class="timeline-item ti-danger ms-2">
                                            <div class="d-flex">
                                                <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="">
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1 fs-6">3 new screen design added: on <a href="#" class="avio-link text_bg2">MA-86</a></div>
                                                    <span class="d-flex text-muted small">New added - 9:24PM by <a class="ms-2" href="#" title=""><strong>You</strong></a> </span>
                                                    <div class="card mt-3 p-3">
                                                        <div class="row g-1">
                                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                                <div class="card img-effect one text-center">
                                                                    <img src="./assets/img/gallery/1.jpg" alt="img hover">
                                                                    <div>
                                                                        <h2 class="fs-4">Chat App</h2>
                                                                        <p>Sadie never took her eyes off me. She had a dark soul.</p>
                                                                        <a href="app-chat.html" title="">View more</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                                <div class="card img-effect one text-center">
                                                                    <img src="./assets/img/gallery/2.jpg" alt="img hover">
                                                                    <div>
                                                                        <h2 class="fs-4">Todo App</h2>
                                                                        <p>Sadie never took her eyes off me. She had a dark soul.</p>
                                                                        <a href="app-todo.html" title="">View more</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                                <div class="card img-effect one text-center">
                                                                    <img src="./assets/img/gallery/5.jpg" alt="img hover">
                                                                    <div>
                                                                        <h2 class="fs-4">File Manager</h2>
                                                                        <p>Sadie never took her eyes off me. She had a dark soul.</p>
                                                                        <a href="app-file-manager.html" title="">View more</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- timeline item end  -->
                                        <div class="timeline-item ti-success ms-2">
                                            <div class="d-flex">
                                                <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="">
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1">Clients share with new documentation file</div>
                                                    <span class="d-flex text-muted small">New file - 11:30AM by <a class="ms-2" href="#" title=""><strong>You</strong></a> </span>
                                                    <div class="card mt-3 p-3">
                                                        <a href="#" class="d-inline-flex align-items-center py-2">
                                                            <div class="avatar rounded-circle no-thumbnail"><i class="fa fa-file-pdf-o text-danger"></i></div>
                                                            <div class="flex-fill ms-3 text-truncate">
                                                                <p class="mb-0 color-800">new layout for admin pages</p>
                                                                <small class="text-muted">.pdf, 5.3 MB</small>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex align-items-center py-2">
                                                            <div class="avatar rounded-circle no-thumbnail"><i class="fa fa-file-zip-o"></i></div>
                                                            <div class="flex-fill ms-3 text-truncate">
                                                                <p class="mb-0 color-800 lh-sm">Brand Photography</p>
                                                                <small class="text-muted">.zip, 30.5 MB</small>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- timeline item end  -->
                                        <div class="timeline-item ti-primary ms-2">
                                            <div class="d-flex">
                                                <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="">
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1">Create new module development team for <a href="#" class="avio-link text_bg2">MA-86</a> stocks for our Instagram channel</div>
                                                    <span class="d-flex text-muted small">ReactJs, Nodejs - 7:58AM by <a class="ms-2" href="#" title=""><strong>You</strong></a> </span>
                                                    <div class="card p-3 mt-3"> What do you think about these? Should I continue in this style? </div>
                                                    <div class="project-members mt-3">
                                                        <label class="me-3">Team :</label>
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ReactJs"><img class="avatar xs rounded-circle" src="./assets/img/xs/avatar3.jpg" alt="friend"> </a>
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="NodeJs"><img class="avatar xs rounded-circle" src="./assets/img/xs/avatar1.jpg" alt="friend"> </a>
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ReactJs"><img class="avatar xs rounded-circle" src="./assets/img/xs/avatar7.jpg" alt="friend"> </a>
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="ReactJs"><img class="avatar xs rounded-circle" src="./assets/img/xs/avatar9.jpg" alt="friend"> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- timeline item end  -->
                                        <div class="timeline-item ti-warning ms-2">
                                            <div class="d-flex">
                                                <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar4.jpg" alt="">
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1">update new source code on GitHub <strong>MA-78 - Retargeting React Webapp</strong></div>
                                                    <span class="d-flex text-muted small">New Dashboard Design - 9:24PM by <a class="ms-2" href="#" title=""><strong>Chris</strong></a> </span>
                                                    <div class="alert alert-success rounded mt-3 mb-0 rounded-4"> I’ve prepared all sizes for you. Can you take a look tonight so we can prepare my final invoice? </div>
                                                </div>
                                            </div>
                                        </div> <!-- timeline item end  -->
                                        <div class="timeline-item ti-info ms-2">
                                            <div class="d-flex">
                                                <img class="avatar sm rounded-circle" src="./assets/img/xs/avatar2.jpg" alt="">
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1 fs-6">Task <a href="#" class="avio-link text_bg2">#1425</a> merged with <a href="#" class="avio-link text_bg2">#25836</a> in Avio Admin Dashboard project:</div>
                                                    <span class="d-flex text-muted small">Updates for Jason Carroll - 7:12PM by <a class="ms-2" href="#" title=""><strong>Orlando</strong></a> </span>
                                                    <div class="card mt-3 p-3">
                                                        <p>Both task merged and latest code push on GitHub</p>
                                                        <ul class="mb-0">
                                                            <li>Responsive design issue fix and testing all device-width</li>
                                                            <li>Profile page create</li>
                                                            <li>Login page text changes</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- timeline item end  -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pd_settings" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Project Settings</h6>
                                        <button class="btn btn-sm d-block d-lg-none btn-primary project-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                                    </div>
                                    <form class="card-body">
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Project Icon</label>
                                            <div class="col-md-10">
                                                <div class="avatar lg rounded-circle no-thumbnail"><i class="fa fa-google fa-2x"></i></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Project Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Project Type</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Project Description</label>
                                            <div class="col-md-10">
                                                <textarea type="text" class="form-control form-control-lg" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Due Date</label>
                                            <div class="col-lg-3 col-md-5 col-md-10">
                                                <input type="date" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Notifications</label>
                                            <div class="col-md-10">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="n_Phone">
                                                    <label class="form-check-label" for="n_Phone">Phone</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="n_email" checked="">
                                                    <label class="form-check-label" for="n_email">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-2 col-form-label">Status</label>
                                            <div class="col-md-10">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="Status" checked="">
                                                    <label class="form-check-label" for="Status">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="card-footer text-end">
                                        <button type="button" class="btn btn-lg btn-white border lift">Discard</button>
                                        <button type="button" class="btn btn-lg btn-primary border lift">Save Changes</button>
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

@endsection

@push('scripts')


<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('supervisi.plan', [$profil->id, Str::slug($profil->project_name)]) }}"
            , success: function(result) {
                $('#container_plan').html(result);
            }
        });

        $.ajax({
            url: "{{ route('supervisi.actual', [$profil->id, Str::slug($profil->project_name)]) }}"
            , success: function(result) {
                $('#container_actual').html(result);
            }
        });
    });

</script>
<!-- Plugin Js -->
<script src="./assets/js/bundle/apexcharts.bundle.js"></script>
<!-- Jquery Page Js -->
<script>
    $('.project-list .project-list-toggle').on('click', function() {
        $('.project-list .order-1').toggleClass('open');
    });
    // Apex-wc-11
    var apexwc12 = {
        chart: {
            height: 260
            , type: 'donut'
        , }
        , labels: ['Active', 'Completed', 'Overdue', 'Yet to start']
        , dataLabels: {
            enabled: false
        , }
        , legend: {
            position: 'bottom', // left, right, top, bottom
            horizontalAlign: 'center', // left, right, top, bottom
        }
        , colors: ['var(--chart-color1)', 'var(--chart-color2)', 'var(--chart-color3)', 'var(--chart-color4)']
        , series: [44, 55, 41, 17]
        , responsive: [{
            breakpoint: 420
            , options: {
                chart: {
                    width: 200
                }
                , legend: {
                    position: 'bottom'
                }
            }
        }]
    }
    new ApexCharts(document.querySelector("#apex-wc-12"), apexwc12).render();
    // Apex-wc-9
    var apexwc9 = {
        series: [{
            name: "Complete"
            , data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
        }, {
            name: "Incomplete"
            , data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
        }]
        , chart: {
            height: 280
            , type: 'line', // line, bar, area
            toolbar: {
                show: false
            , }
            , zoom: {
                enabled: false
            }
        , }
        , colors: ['var(--chart-color1)', 'var(--chart-color5)', ]
        , dataLabels: {
            enabled: false
        }
        , stroke: {
            width: [2, 2]
            , curve: 'smooth', // straight, smooth
            dashArray: [0, 5]
        }
        , legend: {
            tooltipHoverFormatter: function(val, opts) {
                return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
            }
        }
        , markers: {
            size: 0
            , hover: {
                sizeOffset: 6
            }
        }
        , xaxis: {
            categories: ['Jan', 'Feb', 'March', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec']
        , }
        , tooltip: {
            y: [{
                title: {
                    formatter: function(val) {
                        return val + " (Tasks)"
                    }
                }
            }, {
                title: {
                    formatter: function(val) {
                        return val + " (Tasks)"
                    }
                }
            }]
        }
    , };
    new ApexCharts(document.querySelector("#apex-wc-9"), apexwc9).render();

</script>
@endpush
