<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Sarpras - @yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            background:
                radial-gradient(1200px 600px at -10% -10%, rgba(37, 99, 235, 0.07), transparent 50%),
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
            background: var(--primary-50);
            padding: 0.5rem;
            border-radius: 12px;
            margin-right: 0.75rem;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.75rem 1.25rem;
            margin: 0 0.2rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background: var(--primary-50);
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: var(--primary) !important;
            background: var(--primary-50);
            font-weight: 600;
        }

        .nav-link i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* User dropdown */
        .user-dropdown .dropdown-toggle {
            color: var(--text-primary) !important;
            background: transparent;
            border: none;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 12px;
        }

        .main-content {
            margin-top: 2rem;
            padding-bottom: 2rem;
            min-height: calc(100vh - 200px);
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

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

        .footer-custom {
            background: var(--light);
            border-top: 1px solid var(--border);
            padding: 2rem 0;
            margin-top: 3rem;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--border-light);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
        }

        /* Badge & status */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #fff;
            min-width: 100px;
            text-align: center;
        }

    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">

            <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                <i class="fas fa-tools"></i>
                <span>SARPRAS</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                           href="{{ route('user.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.aduan.create') ? 'active' : '' }}"
                           href="{{ route('user.aduan.create') }}">
                            <i class="fas fa-plus-circle"></i>
                            <span>Ajukan Aduan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.aduan.history') ? 'active' : '' }}"
                           href="{{ route('user.aduan.history') }}">
                            <i class="fas fa-history"></i>
                            <span>Riwayat Aduan</span>
                        </a>
                    </li>
                </ul>

                <!-- User menu -->
                <ul class="navbar-nav align-items-center gap-2">
                    @php
                        $unreadCount = \App\Models\Pengaduan::where('id_user', Auth::id())
                            ->where('notified_to_user', false)->count();
                    @endphp
                    @if($unreadCount > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link position-relative" href="#" id="userNotifDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $unreadCount }}
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userNotifDropdown" style="min-width: 350px;">
                                <li><h6 class="dropdown-header">Update Status Aduan</h6></li>
                                <li><hr class="dropdown-divider"></li>
                                @php
                                    $unreadNotifications = \App\Models\Pengaduan::where('id_user', Auth::id())
                                        ->where('notified_to_user', false)
                                        ->orderBy('updated_at', 'desc')
                                        ->limit(5)
                                        ->get();
                                @endphp
                                @forelse($unreadNotifications as $n)
                                    <li class="px-3 py-2 border-bottom">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="flex-grow-1">
                                                <strong class="text-dark">{{ $n->nama_pengaduan }}</strong>
                                                <div class="small text-muted">Status: <span class="badge bg-info">{{ $n->status }}</span></div>
                                                <div class="small text-muted">{{ $n->lokasi }}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('user.aduan.history') }}" class="btn btn-sm btn-primary">Lihat</a>
                                            <form method="POST" action="{{ route('user.aduan.mark-notified', $n->id_pengaduan) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">Mark</button>
                                            </form>
                                        </div>
                                    </li>
                                @empty
                                    <li class="px-3 py-2 text-center text-muted">Tidak ada notifikasi baru</li>
                                @endforelse
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            <span>{{ Auth::user()->nama_pengguna }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-user me-2"></i> Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.profile.edit') }}"><i class="fas fa-edit me-2"></i> Edit Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
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

    <footer class="footer-custom text-center">
        <p class="mb-2">&copy; {{ date('Y') }} <strong class="text-primary">Aplikasi Sarpras</strong> - User Panel</p>
        <small>Sistem Pengaduan Sarana dan Prasarana</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
