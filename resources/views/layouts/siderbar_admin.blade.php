<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        {{-- <a href="/" class="brand-link">
            <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">ADMIN</span>
        </a> --}}
        <a href="{{ route('home_index') }}" class="brand-link">
            <img src="/storage/{{ $data_c1['logo'] }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"  alt="{{ $data_c1['title'] }}" />
            {{-- <span class="brand-text fw-light">BUYPROXY</span> --}}
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">

                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="fa-solid fa-house-chimney mt-1"></i>
                        <p>Trang khách hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="fa-solid fa-house-laptop mt-1"></i>
                        <p>Trang quản trị admin</p>
                    </a>
                </li>
                <li class="nav-header">QUẢN LÝ</li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                        {{-- <i class="nav-icon bi bi-circle text-danger"></i> --}}
                        <i class="fas fa-user mt-1"></i>
                        <p class="text">Danh sách người dùng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('api.index')}}" class="nav-link">
                        {{-- <i class="nav-icon bi bi-circle text-danger"></i> --}}
                        <i class="fa-solid fa-laptop-code mt-1"></i>
                        <p class="text">Danh sách API</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('proxy.index')}}" class="nav-link">
                        {{-- <i class="nav-icon bi bi-circle text-danger"></i> --}}
                        <i class="fa-brands fa-internet-explorer mt-1"></i>
                        <p class="text">Danh sách proxy</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link">
                        {{-- <i class="nav-icon bi bi-circle text-warning"></i> --}}
                        <i class="fas fa-wallet mt-1"></i>
                        <p>Danh sách tin tức</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        {{-- <i class="nav-icon bi bi-circle text-info"></i> --}}
                        <i class="fas fa-coins mt-1"></i>
                        <p>Danh sách đơn mua</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transactions.index') }}" class="nav-link">
                        {{-- <i class="nav-icon bi bi-circle text-info"></i> --}}
                        <i class="fas fa-coins mt-1"></i>
                        <p>Lịch sử nạp - trừ tiền</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('notifications.index') }}" class="nav-link">
                        {{-- <i class="nav-icon bi bi-circle text-info"></i> --}}
                        <i class="fas fa-toolbox mt-1"></i>
                        <p>Quản lý thông báo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('configs.index') }}" class="nav-link">
                        {{-- <i class="nav-icon bi bi-circle text-info"></i> --}}
                        <i class="fas fa-code mt-1"></i>
                        <p>Cài đặt</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fas fa-outdent mt-1"></i>
                        <p>Đăng xuất</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
