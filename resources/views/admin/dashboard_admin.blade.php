@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid py-4">

    {{-- SELAMAT DATANG --}}
    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
        <h3 class="fw-bold mb-1">Selamat datang, {{ Auth::user()->nama_pengguna ?? Auth::user()->name }} 👋</h3>
        <p class="text-muted">Anda login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
    </div>

    {{-- STATISTIK STATUS --}}
    <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
        <h5 class="fw-semibold mb-3">📊 Progress Penyelesaian Pengaduan</h5>

        @php
            $progress = ($totalPengaduan > 0)
                        ? number_format(($pengaduanSelesai / $totalPengaduan) * 100, 1)
                        : 0;
        @endphp

        <div class="d-flex justify-content-between mb-2 small">
            <span>Progress Penyelesaian</span>
            <span>{{ $progress }}%</span>
        </div>
        <div class="progress" style="height: 11px;">
            <div class="progress-bar bg-success"
                style="width: {{ $progress }}%;">
            </div>
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="row g-4 mb-4">

        {{-- DONUT STATUS --}}
        <div class="col-12 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📈 Distribusi Status Pengaduan</h5>
                </div>
                <div class="card-body" style="height: 300px;">
                    <canvas id="statusDistributionChart"></canvas>
                </div>
            </div>
        </div>

        {{-- TREND LINE --}}
        <div class="col-12 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📅 Tren Pengaduan 7 Hari Terakhir</h5>
                </div>
                <div class="card-body" style="height: 300px;">
                    <canvas id="weeklyTrendChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- PENGADUAN TERBARU --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📋 Pengaduan Terbaru</h5>
            <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-light">
                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Pengadu</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($recentPengaduan as $key => $p)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>
                                <strong>{{ $p->nama_pengaduan }}</strong><br>
                                <small class="text-muted">{{ Str::limit($p->deskripsi, 60) }}</small>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle text-white fw-bold d-flex justify-content-center align-items-center me-2"
                                         style="width: 32px; height: 32px;">
                                        {{ strtoupper(substr($p->user->nama_pengguna ?? 'U', 0, 1)) }}
                                    </div>
                                    {{ $p->user->nama_pengguna ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $p->lokasi }}
                                </span>
                            </td>

                            <td>
                                @if($p->status == 'Selesai')
                                    <span class="badge bg-success">✔ Selesai</span>
                                @elseif($p->status == 'Diproses')
                                    <span class="badge bg-warning text-dark">⟳ Diproses</span>
                                @elseif($p->status == 'Ditolak')
                                    <span class="badge bg-danger">✘ Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">{{ $p->status }}</span>
                                @endif
                            </td>

                            <td>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}<br>
                                    <span class="text-dark">{{ \Carbon\Carbon::parse($p->created_at)->format('H:i') }}</span>
                                </small>
                            </td>

                            <td>
                                <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}"
                                   class="btn btn-sm btn-outline-primary">
                                   <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                <p>Belum ada pengaduan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    /* =======================
       CHART: DONUT STATUS
    ========================= */
    new Chart(document.getElementById('statusDistributionChart'), {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Diproses', 'Diajukan', 'Ditolak'],
            datasets: [{
                data: [
                    {{ $pengaduanSelesai ?? 0 }},
                    {{ $pengaduanDiproses ?? 0 }},
                    {{ $pengaduanDiajukan ?? 0 }},
                    {{ $pengaduanDitolak ?? 0 }}
                ],
                backgroundColor: ['#28a745','#ffc107','#17a2b8','#dc3545'],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
            }
        }
    });

    /* =======================
       CHART: TREND MINGGUAN
    ========================= */
    new Chart(document.getElementById('weeklyTrendChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($last7Days) !!},
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: {!! json_encode($last7DaysData) !!},
                borderColor: '#28a745',
                backgroundColor: 'rgba(40,167,69,0.15)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

});
</script>
@endpush
