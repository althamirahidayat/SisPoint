@extends('layouts.admin') 
@section('styles')
<style>
    /* Welcome Card Styling */
    .welcome-card {
        background: #1E293B;
        color: white;
        padding: 25px 30px;
        border-radius: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .welcome-card h2 { font-size: 24px; font-weight: 800; margin: 0; letter-spacing: 0.5px; }
    .welcome-card .class-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.15);
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        margin-top: 12px;
    }
    .welcome-card .time-info { text-align: right; }
    .welcome-card .time-info .time { font-size: 20px; font-weight: 800; }
    .welcome-card .time-info .date { font-size: 13px; color: #94A3B8; font-weight: 700; margin-top: 5px; text-transform: uppercase; }

    /* Quick Access Section */
    .section-title { font-size: 14px; color: #94A3B8; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; }
    .quick-access-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: white;
        padding: 15px 25px;
        border-radius: 15px;
        text-decoration: none;
        color: #1E293B;
        font-weight: 800;
        font-size: 13px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border: none;
    }
    .quick-access-btn .icon-box {
        width: 32px;
        height: 32px;
        background: #2563EB;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Stats Grid (2 Columns for Siswa) */
    .stats-grid-siswa { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 30px; }
    .stat-card-siswa {
        background: white;
        padding: 25px;
        border-radius: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }
    .stat-card-siswa::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0; width: 6px;
    }
    .stat-card-siswa.pelanggaran::before { background: #EF4444; }
    .stat-card-siswa.prestasi::before { background: #F97316; }
    
    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 15px;
    }
    .stat-card-siswa.pelanggaran .icon-circle { background: #FEE2E2; color: #EF4444; }
    .stat-card-siswa.prestasi .icon-circle { background: #FFEDD5; color: #F97316; }
    
    .stat-card-siswa p { font-size: 14px; color: #64748B; font-weight: 600; margin: 0; }
    .stat-card-siswa h3 { font-size: 32px; font-weight: 800; margin: 8px 0 0 0; color: #1E293B; }

    /* Bottom Layout */
    .bottom-section { display: grid; grid-template-columns: 1.6fr 1.1fr; gap: 25px; }
    .content-box { background: white; padding: 25px; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .box-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .box-header h3 { font-size: 16px; font-weight: 800; color: #1E293B; margin: 0; }

    /* Activity Items Custom to Match Image */
    .activity-item { display: flex; align-items: center; gap: 15px; padding: 15px 0; border-bottom: 1px solid #F1F5F9; }
    .activity-item:last-child { border: none; }
    .act-icon-status {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    .act-icon-status.danger { background: #FEE2E2; color: #EF4444; }
    .act-icon-status.success { background: #D1FAE5; color: #10B981; }
    
    .act-info { flex-grow: 1; }
    .act-info p { font-size: 13px; font-weight: 800; color: #1E293B; margin: 0; }
    .act-info p span { color: #64748B; font-weight: 500; }
    .act-info .sub-text { font-size: 11px; color: #94A3B8; font-weight: 600; margin-top: 2px; display: block; }
    
    .act-points-badge { text-align: right; }
    .act-points-badge .pts { font-weight: 800; font-size: 13px; }
    .act-points-badge .date { font-size: 10px; color: #94A3B8; font-weight: 600; display: block; margin-top: 2px; }

    /* Top Siswa / Leaderboard Widget */
    .top-siswa-card {
        background: white;
        padding: 25px;
        border-radius: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        border: 2px solid #F97316; /* Orange outline like in design */
    }
    .top-siswa-item { display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid #F1F5F9; }
    .top-siswa-item:last-child { border: none; }
    
    .rank-badge {
        font-weight: 800; font-size: 12px; width: 24px; height: 24px;
        border-radius: 6px; display: flex; align-items: center; justify-content: center;
    }
    .rank-badge.rank-1 { background: #FFEDD5; color: #F97316; }
    .rank-badge.rank-2 { background: #F1F5F9; color: #64748B; }
    .rank-badge.rank-3 { background: #FDF2E9; color: #C2410C; }
    .rank-badge.rank-other { background: #F8FAFC; color: #94A3B8; }
    
    .top-info { flex-grow: 1; }
    .top-info .name { font-size: 13px; font-weight: 800; color: #1E293B; display: block; }
    .top-info .class { font-size: 10px; color: #94A3B8; font-weight: 700; }
    .top-pts { font-size: 12px; font-weight: 800; color: #10B981; }
</style>
@endsection

@section('content')
<div class="welcome-card">
    <div>
        <h2>SELAMAT PAGI, SISWA SMK NEGERI 1!</h2>
        <div class="class-badge">XI PPLG B</div>
    </div>
    <div class="time-info">
        <div class="time">{{ \Carbon\Carbon::now()->format('H:i') }}</div>
        <div class="date">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM') }}</div>
    </div>
</div>

<h4 class="section-title">Akses Cepat</h4>
<a href="#" class="quick-access-btn">
    <div class="icon-box">
        <i class="fa-solid fa-clock-rotate-left"></i>
    </div>
    Lihat Riwayat
</a>

<div class="stats-grid-siswa">
    <div class="stat-card-siswa pelanggaran">
        <div class="icon-circle">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <p>Poin Pelanggaran Saya</p>
        <h3>{{ $poinPelanggaran ?? 15 }}</h3>
    </div>
    <div class="stat-card-siswa prestasi">
        <div class="icon-circle">
            <i class="fa-solid fa-award"></i>
        </div>
        <p>Total Prestasi Saya</p>
        <h3>{{ $totalPrestasi ?? 3 }}</h3>
    </div>
</div>

<div class="bottom-section">
    <div class="content-box">
        <div class="box-header">
            <h3>Aktivitas 7 Hari Terakhir</h3>
            <a href="#" style="font-size: 11px; color: #2563EB; font-weight: 700; text-decoration: none;">Lihat Semua Riwayat</a>
        </div>
        
        {{-- Loop riwayat log aktivitas siswa --}}
        <div class="activity-item">
            <div class="act-icon-status danger">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="act-info">
                <p>Pelanggaran Dicatat</p>
                <span class="sub-text">Terlambat masuk sekolah</span>
            </div>
            <div class="act-points-badge">
                <span class="pts" style="color: #EF4444;">-5 Poin</span>
                <span class="date">20 Feb 2026</span>
            </div>
        </div>

        <div class="activity-item">
            <div class="act-icon-status success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="act-info">
                <p>Prestasi Diraih</p>
                <span class="sub-text">Juara 1 lomba coding</span>
            </div>
            <div class="act-points-badge">
                <span class="pts" style="color: #10B981;">+50 Poin</span>
                <span class="date">15 Feb 2026</span>
            </div>
        </div>

        <div class="activity-item">
            <div class="act-icon-status danger">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="act-info">
                <p>Pelanggaran Dicatat</p>
                <span class="sub-text">Atribut tidak lengkap</span>
            </div>
            <div class="act-points-badge">
                <span class="pts" style="color: #EF4444;">-10 Poin</span>
                <span class="date">10 Feb 2026</span>
            </div>
        </div>
    </div>

    <div class="top-siswa-card">
        <div class="box-header">
            <h3>Top Siswa</h3>
        </div>
        
        <div style="margin-bottom: 20px;">
            {{-- Bagian ini nanti diintegrasikan dengan @forelse($topSiswa) --}}
            <div class="top-siswa-item">
                <span class="rank-badge rank-1">1</span>
                <div class="top-info">
                    <span class="name">Citra Lestari</span>
                    <span class="class">XI TKJ B</span>
                </div>
                <span class="top-pts">12 Prestasi</span>
            </div>

            <div class="top-siswa-item">
                <span class="rank-badge rank-2">2</span>
                <div class="top-info">
                    <span class="name">Budi Santoso</span>
                    <span class="class">XI RPL A</span>
                </div>
                <span class="top-pts">8 Prestasi</span>
            </div>

            <div class="top-siswa-item">
                <span class="rank-badge rank-3">3</span>
                <div class="top-info">
                    <span class="name">Eko Prasetyo</span>
                    <span class="class">X TKR A</span>
                </div>
                <span class="top-pts">5 Prestasi</span>
            </div>

            <div class="top-siswa-item">
                <span class="rank-badge rank-other">4</span>
                <div class="top-info">
                    <span class="name">Ahmad Fauzi</span>
                    <span class="class">XII RPL B</span>
                </div>
                <span class="top-pts">3 Prestasi</span>
            </div>

            <div class="top-siswa-item">
                <span class="rank-badge rank-other">5</span>
                <div class="top-info">
                    <span class="name">Dewi Anggraeni</span>
                    <span class="class">X DKV B</span>
                </div>
                <span class="top-pts">1 Prestasi</span>
            </div>
        </div>

        <a href="#" style="display: block; text-align: center; padding: 12px; border: 1px solid #E2E8F0; border-radius: 12px; text-decoration: none; color: #1E293B; font-weight: 800; font-size: 13px;">Lihat Leaderboard</a>
    </div>
</div>
@endsection