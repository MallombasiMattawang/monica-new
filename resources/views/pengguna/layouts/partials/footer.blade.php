{{-- <div class="page-footer bg-card mt-4">
    <div class="container-fluid">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-2">
            <p class="col-md-5 mb-0 text-muted">© 2023 <a href="javascript:void(0)">Meja Kerja</a>. <span
                    class="fa fa-heart text-danger"></span> by <a href="javascript:void(0)"> Awan </a></p>
            <ul class="nav col-md-7 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Support</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link px-2 text-muted">Sign out</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </footer>
    </div>
</div> --}}

<!-- Modal: Setting -->
<div class="modal fade" id="SettingsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-vertical right-side modal-dialog-scrollable">
        <div class="modal-content">
            <div class="px-xl-4 modal-header">
                <h5 class="modal-title">Theme Setting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="px-xl-4 modal-body custom_scroll">
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

            </div>
            <div class="px-xl-4 modal-footer d-flex justify-content-start text-center">
                <button type="button" class="btn flex-fill btn-primary lift">Save Changes</button>
                <button type="button" class="btn flex-fill btn-white border lift"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
