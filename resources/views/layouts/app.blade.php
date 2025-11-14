<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Sarpras - @yield('title', 'Dashboard Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            background: radial-gradient(1200px 600px at -10% -10%, rgba(37, 99, 235, 0.07), transparent 50%),
                        radial-gradient(1000px 500px at 110% -20%, rgba(16, 185, 129, 0.06), transparent 50%),
                        radial-gradient(800px 400px at 50% 120%, rgba(245, 158, 11, 0.06), transparent 50%),
                        var(--light-bg);
            min-height: 100vh;
            color: var(--text-primary);
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255,255,255,0.6);
            border-bottom: 1px solid var(--border);
            padding: 0.85rem 0;
            box-shadow: var(--shadow);
            backdrop-filter: saturate(1.2) blur(10px);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-primary) !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            color: var(--primary);
            background: linear-gradient(135deg, var(--primary-50), transparent);
            padding: 0.5rem;
            border-radius: 12px;
            margin-right: 0.75rem;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.6rem 1rem;
            margin: 0 0.2rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background: rgba(37, 99, 235, 0.1);
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: var(--primary) !important;
            background: rgba(37, 99, 235, 0.12);
            font-weight: 600;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: var(--primary);
            border-radius: 2px;
        }

        .nav-link i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* User Dropdown */
        .user-dropdown .dropdown-toggle {
            color: var(--text-primary) !important;
            background: transparent;
            border: none;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .user-dropdown .dropdown-toggle:hover {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary) !important;
        }

        .user-dropdown .dropdown-menu {
            background: var(--light);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            padding: 0.5rem;
            min-width: 200px;
        }

        .user-dropdown .dropdown-item {
            color: var(--text-secondary);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .user-dropdown .dropdown-item:hover {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            transform: translateX(5px);
        }

        /* Main Content */
        .main-content {
            margin-top: 2rem;
            padding-bottom: 2rem;
            min-height: calc(100vh - 200px);
        }

        .content-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Cards */
        .card-custom {
            background: var(--light-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        /* Footer */
        .footer-custom {
            background: var(--light);
            border-top: 1px solid var(--border);
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .footer-custom p {
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
        }

        .footer-custom small {
            color: var(--text-muted);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }

            .nav-link {
                padding: 0.6rem 0.9rem;
                margin: 0.1rem;
                border-radius: 10px;
            }

            .nav-link.active::before {
                display: none;
            }

            .main-content {
                margin-top: 1rem;
            }

            .user-dropdown .dropdown-toggle {
                padding: 0.5rem 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand span { display: none; }

            .navbar-brand i { margin-right: 0; }

            .nav-link span { display: none; }

            .nav-link i { margin-right: 0; font-size: 1.2rem; }

            .user-dropdown .dropdown-toggle span { display: none; }
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tools"></i>
                <span>SARPRAS</span>
                <span class="admin-badge">ADMIN</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto align-items-center gap-1">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                           href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users"></i>
                            <span>User</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.temp.items') ? 'active' : '' }}"
                           href="{{ route('admin.temp.items') }}">
                            <i class="fas fa-inbox"></i>
                            <span>Item request</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}"
                           href="{{ route('admin.petugas.index') }}">
                            <i class="fas fa-user-shield"></i>
                            <span>Petugas</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}"
                           href="{{ route('admin.pengaduan.index') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Pengaduan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.items.*') ? 'active' : '' }}"
                           href="{{ route('admin.items.index') }}">
                            <i class="fas fa-box"></i>
                            <span>Item</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.lokasi.*') ? 'active' : '' }}"
                           href="{{ route('admin.lokasi.index') }}">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lokasi</span>
                        </a>
                    </li>
                </ul>

                <!-- User Menu -->
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-cog me-2"></i>
                            <span>{{ Auth::user()->nama_pengguna ?? 'Admin' }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>

                    </li>
                </ul>

            </div>

        </div>
    </nav>

    <div class="main-content">
        <div class="container content-container">
            @yield('content')
        </div>
    </div>

    <footer class="footer-custom">
        <div class="container text-center">
            <p class="mb-2">
                &copy; {{ date('Y') }} <strong class="text-primary">Aplikasi Sarpras</strong> - Admin Panel
            </p>
            <small>Sistem Pengaduan Sarana dan Prasarana - admin</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
