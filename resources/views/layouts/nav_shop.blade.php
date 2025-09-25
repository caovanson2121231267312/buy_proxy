<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{ route('home') }}" class="nav-link">Trang chủ</a></li>
            @if (auth()->user()->role == 1)
                <li class="nav-item d-none d-md-block"><a href="{{ route('admin.dashboard') }}" class="nav-link">Trang
                        admin</a></li>
            @endif

        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <b>Số dư: </b>
                    <span
                        class="text-danger fw-bold">{{ number_format(Auth::user()->price, 0, ',', '.') . ' ₫' }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown d-none">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-text"></i>
                    <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <a href="#" class="dropdown-item">
                        <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="./assets/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 rounded-circle me-3" />
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span>
                                </h3>
                                <p class="fs-7">Call me whenever you can...</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="./assets/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 rounded-circle me-3" />
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-end fs-7 text-secondary">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">I got your message bro</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!--begin::Message-->
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="./assets/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 rounded-circle me-3" />
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-end fs-7 text-warning">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">The subject goes here</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!--end::Message-->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item">
                <div class="sidebar">
                    <div class="notification-icon" id="notifyToggle">
                        🔔
                        <span class="badge" id="notifyCount">{{ $notifications->count() ?? 0 }}</span>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown d-none">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-envelope me-2"></i> 4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-people-fill me-2"></i> 8 friend requests
                        <span class="float-end text-secondary fs-7">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                        <span class="float-end text-secondary fs-7">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/avatar.png') }}" class="user-image rounded-circle shadow"
                        alt="{{ Auth::user()->name }}" />
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header text-bg-primary">
                        <img src="{{ asset('assets/avatar.png') }}" class="rounded-circle shadow" alt="User Image" />
                        <p>
                            {{ Auth::user()->email }}
                            <small>Member since Nov. 2025</small>
                        </p>
                    </li>
                    <!--end::User Image-->
                    <!--begin::Menu Body-->

                    <!--end::Menu Body-->
                    <!--begin::Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                        <a class="btn btn-default btn-flat float-end" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <p>Logout</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<div class="notify-offcanvas" id="notifyPanel">
    <div class="notify-header">
        <h3>Thông báo</h3>
        <span class="close-btn" id="notifyClose">&times;</span>
    </div>
    <ul class="notify-list">
        @foreach ($notifications as $notify)
            <li>
                <a href="#" class="notify-item" data-title="{{ $notify->title }}"
                    data-content="{{ $notify->content }}">
                    {{ $notify->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<!-- Modal -->
<div class="notify-modal" id="notifyModal">
    <div class="notify-modal-content">
        <span class="close-btn" id="modalClose">&times;</span>
        <h2 id="modalTitle"></h2>
        <p id="modalContent"></p>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const panel = document.getElementById("notifyPanel");
        const toggle = document.getElementById("notifyToggle");
        const closeBtn = document.getElementById("notifyClose");
        const modal = document.getElementById("notifyModal");
        const modalTitle = document.getElementById("modalTitle");
        const modalContent = document.getElementById("modalContent");
        const modalClose = document.getElementById("modalClose");

        // mở offcanvas
        toggle.addEventListener("click", () => {
            panel.classList.add("active");
        });

        // đóng offcanvas
        closeBtn.addEventListener("click", () => {
            panel.classList.remove("active");
        });

        // mở modal khi click vào thông báo
        document.querySelectorAll(".notify-item").forEach(item => {
            item.addEventListener("click", (e) => {
                e.preventDefault();
                modalTitle.textContent = item.dataset.title;
                modalContent.textContent = item.dataset.content;
                modal.classList.add("active");
            });
        });

        // đóng modal
        modalClose.addEventListener("click", () => {
            modal.classList.remove("active");
        });
        modal.addEventListener("click", (e) => {
            if (e.target === modal) modal.classList.remove("active");
        });
    });
</script>


<style>
    .notification-icon {
        position: relative;
        font-size: 22px;
        cursor: pointer;
    }

    .notification-icon .badge {
        position: absolute;
        top: -8px;
        right: -10px;
        background: red;
        color: #fff;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 50%;
    }

    /* Offcanvas panel */
    .notify-offcanvas {
        position: fixed;
        top: 0;
        right: -350px;
        width: 300px;
        height: 100%;
        background: #fff;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
        transition: right 0.3s ease;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    .notify-offcanvas.active {
        right: 0;
        z-index: 100000;
    }

    .notify-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background: #007bff;
        color: #fff;
    }

    .notify-header .close-btn {
        font-size: 22px;
        cursor: pointer;
    }

    .notify-list {
        list-style: none;
        margin: 0;
        padding: 0;
        overflow-y: auto;
        flex: 1;
    }

    .notify-list li {
        border-bottom: 1px solid #eee;
    }

    .notify-list a {
        display: block;
        padding: 12px 15px;
        text-decoration: none;
        color: #333;
        transition: background 0.2s;
    }

    .notify-list a:hover {
        background: #f1f1f1;
    }

    /* Modal */
    .notify-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1100;
    }

    .notify-modal.active {
        display: flex;
    }

    .notify-modal-content {
        background: #fff;
        padding: 20px;
        width: 400px;
        max-width: 90%;
        border-radius: 8px;
        position: relative;
        animation: fadeIn 0.3s ease;
    }

    .notify-modal-content h2 {
        margin-top: 0;
    }

    .notify-modal-content .close-btn {
        position: absolute;
        top: 10px;
        right: 12px;
        font-size: 22px;
        cursor: pointer;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
