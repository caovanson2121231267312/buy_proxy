<style>
    .app-sidebar {
        /* max-width: none!important; */
    }
</style>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('home_index') }}" class="brand-link">
            <img src="/storage/{{ $data_c1['logo'] }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"  alt="{{ $data_c1['title'] }}" />
            {{-- <span class="brand-text fw-light">BUYPROXY</span> --}}
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">

                {{-- <li class="nav-header">ĐĂNG KÝ DỊCH VỤ</li>
                @foreach ($data_proxy as $key => $value)
                    <li class="nav-item">
                        <a href="{{ route('proxy.show', ['proxy_type' => $value->proxy_type]) }}" data-type="{{  $value->proxy_type }}" class="nav-link">
                            <p class="text">{{  $value->proxy_type_name }}</p>
                        </a>
                    </li>
                @endforeach --}}

                <li class="nav-header">TÀI KHOẢN</li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="fa-solid fa-house mt-1"></i>
                        <p>Trang chủ - dịch vụ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_orders') }}" class="nav-link">
                        <i class="fa-solid fa-bars mt-1"></i>
                        <p>Quản lý proxy của tôi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="fas fa-user mt-1"></i>
                        <p class="text">Thông tin tài khoản</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.payment') }}" class="nav-link">
                        <i class="fas fa-wallet mt-1"></i>
                        <p>Nạp tiền</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my.transactions.index') }}" class="nav-link">
                        <i class="fas fa-coins mt-1"></i>
                        <p>Lịch sử giao dịch</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.token') }}" class="nav-link">
                        <i class="fas fa-code mt-1"></i>
                        <p>Tích hợp api</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-toolbox mt-1"></i>
                        <p>Tool hỗ trợ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file mt-1"></i>
                        <p>Tin tức & Hướng dẫn</p>
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
        </nav>
    </div>
</aside>
