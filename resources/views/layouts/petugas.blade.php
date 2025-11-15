<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas - @yield('title', 'Dashboard')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-50: #eef2ff;
            --secondary: #64748b;
            --accent: #f59e0b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #ffffff;
            --light-bg: #f6f8fb;
            --light-card: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #334155;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --shadow: 0 8px 24px rgba(2, 6, 23, 0.08);
            --shadow-lg: 0 16px 36px rgba(2, 6, 23, 0.12);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            min-height: 100vh;
            color: var(--text-primary);
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255,255,255,0.7);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(8px);
            padding: 0.65rem 0;
            box-shadow: var(--shadow);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            color: var(--text-primary) !important;
        }

        .navbar-brand i {
            color: var(--primary);
            background: var(--primary-50);
            padding: 0.45rem;
            border-radius: 10px;
            margin-right: 0.65rem;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.6rem 0.9rem;
            border-radius: 10px;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-link:hover {
            background: var(--primary-50);
            color: var(--primary) !important;
        }

        .nav-link.active {
            background: var(--primary-50);
            color: var(--primary) !important;
            font-weight: 600;
        }

        /* Hide text & compress navbar on small screens */
        @media (max-width: 576px) {
            .navbar-brand span { display: none; }
            .navbar-brand i { margin-right: 0; }

            .nav-link span { display: none; }
            .nav-link i { margin-right: 0; font-size: 1.3rem; }

            .user-dropdown .dropdown-toggle span { display: none; }
        }

        /* Dropdown */
        .user-dropdown .dropdown-menu {
            background: var(--light);
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-lg);
        }

        .user-dropdown .dropdown-item:hover {
            background: var(--primary-50);
            color: var(--primary);
        }

        /* Content area */
        .main-content {
            margin-top: 1.5rem;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-top: 1rem;
                padding: 0 0.5rem;
            }
        }

        /* Table responsiveness */
        table {
            width: 100%;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Footer */
        .footer-custom {
            background: var(--light);
            border-top: 1px solid var(--border);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        @media (max-width: 600px) {
            .footer-custom {
                padding: 1rem 0;
            }
        }

    </style>

    @stack('styles')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">

            <a class="navbar-brand" href="{{ route('petugas.dashboard') }}">
                <i class="fas fa-user-cog"></i>
                <span>SARPRAS PETUGAS</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}"
                           href="{{ route('petugas.dashboard') }}">
                            <i class="fas fa-home"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('petugas.pengaduan.index') ? 'active' : '' }}"
                           href="{{ route('petugas.pengaduan.index') }}">
                            <i class="fas fa-clipboard-list"></i> <span>Pengaduan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('petugas.riwayat') ? 'active' : '' }}"
                           href="{{ route('petugas.riwayat') }}">
                            <i class="fas fa-history"></i> <span>Riwayat</span>
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav align-items-center gap-2">

                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ Auth::user()->nama_pengguna ?? 'Petugas' }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <!-- Content -->
    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container text-center">
            <p class="mb-1">&copy; {{ date('Y') }} <strong class="text-primary">Aplikasi Sarpras</strong> - Petugas Panel</p>
            <small>Sistem Pengaduan Sarana dan Prasarana</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
