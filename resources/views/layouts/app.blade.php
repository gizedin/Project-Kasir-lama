<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <style>
        /* ===== NAVBAR FIX RESPONSIVE ===== */
        .navbar-custom {
            background: linear-gradient(90deg, #4e73df, #1cc88a);
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .navbar-brand {
            font-size: 1rem;
             margin-left: 45px !important;
        }

        /* Mobile – biar judul ADMIN PANEL di tengah */
        @media (max-width: 768px) {
            .navbar-custom .container-fluid {
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            .navbar-toggler-mobile {
                position: absolute;
                left: 10px;
                top: 50%;
                transform: translateY(-50%);
            }

            .navbar-right-mobile {
                display: none;
            }

            .navbar-brand {
                text-align: center;
                margin-left: auto;
                margin-right: auto;
            }
        }

        /* ===== LAYOUT ===== */
        .layout-wrapper {
            display: flex;
            min-height: calc(100vh - 60px);
            width: 100%;
        }

        .sidebar-desktop {
            width: 240px;
            display: block;
        }

        .content-wrapper {
            flex-grow: 1;
            padding: 20px;
            background: #fff;
        }

        @media (max-width: 768px) {
            .layout-wrapper {
                flex-direction: column;
            }

            .sidebar-desktop {
                display: none !important;
            }

            .content-wrapper {
                padding: 15px;
            }
        }

        /* ===== TABLE MOBILE ===== */
        @media (max-width: 768px) {
            .table-responsive-mobile {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table.dataTable th,
            table.dataTable td {
                padding: 6px 4px !important;
                font-size: 12px !important;
                white-space: nowrap;
            }

            .btn-sm-mobile {
                padding: 4px 8px !important;
                font-size: 12px !important;
            }
        }
    </style>
</head>

<body>

    @php
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
    @endphp

    <!-- ===== NAVBAR FIXED ===== -->
    <nav class="navbar navbar-expand-md navbar-custom shadow-sm">
        <div class="container-fluid">

            <!-- Button menu mobile -->
            <button class="btn btn-light d-md-none navbar-toggler-mobile"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarOffcanvas">
                ☰
            </button>

            <!-- Title -->
            <a class="navbar-brand fw-bold text-white" href="{{ route('dashboard') }}">
                ADMIN PANEL
            </a>

            <!-- Right section (desktop) -->
            <div class="ms-auto d-flex align-items-center navbar-right-mobile">
                <span class="text-white fw-semibold me-3">
                    {{ auth()->user()->username }}
                </span>

                <a class="text-white fw-semibold" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>
    </nav>

    <!-- ===== MAIN WRAPPER ===== -->
    <div class="layout-wrapper">

        <!-- Sidebar Desktop -->
        <div class="sidebar-desktop">
            @include('layouts.sidebar')
        </div>

        <!-- Sidebar Offcanvas (Mobile) -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>

            <div class="offcanvas-body p-0">
                <div class="p-3 text-white"
                     style="background: linear-gradient(180deg, #1cc88a, #4e73df); min-height: 100%;">
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content-wrapper">
            @yield('content')
        </div>

    </div>

    <footer class="bg-light text-center py-3 border-top mt-3">
        <small>© 2025 App</small>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    @stack('scripts')

</body>
</html>
