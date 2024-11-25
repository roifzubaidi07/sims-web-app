<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" style="padding-top: 2px; background-color: #f3271c;" id="sidenavAccordion">
            <div class="sb-sidenav-menu" >
                <div class="nav">
                    <!-- Navbar Brand-->
                    <a class="nav-link active ps-3 p-3" href="/">
                        <div class="sb-nav-link-icon mb-1"><img src="{{ asset('assets/handbag.png') }}" alt=""></div>
                        SIMS Web Apps
                        <!-- Sidebar Toggle-->
                        {{-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> --}}
                    </a>
                    <a class="nav-link active" href="/products">
                        <div class="sb-nav-link-icon mb-1"><img src="{{ asset('assets/package.png') }}" alt=""></div>
                        Produk
                    </a>
                    <a class="nav-link active" href="/profile">
                        <div class="sb-nav-link-icon mb-1"><img src="{{ asset('assets/user.png') }}" alt=""></div>
                        Profil
                    </a>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link active">
                            <div class="sb-nav-link-icon mb-1"><img src="{{ asset('assets/signout.png') }}" alt=""></div>
                            Logout
                        </button>

                    </form>

                    
              </div>
            </div>
        </nav>
    </div>