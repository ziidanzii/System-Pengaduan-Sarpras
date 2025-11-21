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

        /* User Dropdown */
        .user-dropdown .dropdown-menu {
            background: var(--light);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
        }

        .user-dropdown .dropdown-item:hover {
            background: var(--primary-50);
            color: var(--primary);
            transform: translateX(5px);
        }

        /* Main */
        .main-content {
            margin-top: 2rem;
            padding-bottom: 2rem;
            min-height: calc(100vh - 200px);
        }

        /* Footer */
        .footer-custom {
            background: var(--light);
            border-top: 1px solid var(--border);
            padding: 2rem 0;
            margin-top: 3rem;
        }

        /* Custom status */
        .status-disetujui {
            background-color: var(--secondary) !important;
            color: var(--light) !important;
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
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('petugas.pengaduan.index') ? 'active' : '' }}"
                           href="{{ route('petugas.pengaduan.index') }}">
                            <i class="fas fa-clipboard-list"></i> Pengaduan
                            @php
                                $newCount = \App\Models\Pengaduan::where('status', 'Diajukan')
                                    ->where('id_petugas', null)->count();
                            @endphp
                            @if($newCount > 0)
                                <span class="badge bg-danger rounded-pill ms-2">{{ $newCount }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('petugas.riwayat') ? 'active' : '' }}"
                           href="{{ route('petugas.riwayat') }}">
                            <i class="fas fa-history"></i> Riwayat
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav align-items-center gap-2">

                    @php
                        $unreadNewPengaduan = \App\Models\Pengaduan::where('status', 'Diajukan')
                            ->where('notified_to_petugas', false)->count();
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" id="notifDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            @if($unreadNewPengaduan > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $unreadNewPengaduan }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown" style="min-width: 350px;">
                            <li><h6 class="dropdown-header">Pengaduan Baru</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            @php
                                $newPengaduan = \App\Models\Pengaduan::where('status', 'Diajukan')
                                    ->where('notified_to_petugas', false)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            @forelse($newPengaduan as $p)
                                <li class="px-3 py-2 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="flex-grow-1">
                                            <strong class="text-dark">{{ $p->nama_pengaduan }}</strong>
                                            <div class="small text-muted">{{ $p->user->nama_pengguna ?? 'User' }}</div>
                                            <div class="small text-muted">{{ $p->lokasi }}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('petugas.pengaduan.show', $p->id_pengaduan) }}" class="btn btn-sm btn-primary">Lihat</a>
                                        <form method="POST" action="{{ route('petugas.pengaduan.mark-notified', $p->id_pengaduan) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Mark</button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="px-3 py-2 text-center text-muted">Tidak ada pengaduan baru</li>
                            @endforelse
                        </ul>
                    </li>

                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            {{ Auth::user()->nama_pengguna ?? 'Petugas' }}
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
