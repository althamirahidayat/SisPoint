@extends('layouts.admin')

@section('styles')
<style>
    .welcome-card {
        background: #111827;
        color: white;
        padding: 30px;
        border-radius: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    .welcome-card h2 { font-size: 24px; font-weight: 800; }
    .welcome-card p { font-size: 14px; color: #94A3B8; margin-top: 5px; }

    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
    .stat-card {
        background: white; padding: 20px; border-radius: 20px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }
    .stat-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; }
    .stat-icon { width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .trend { font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: 20px; }
    .trend.up { color: #10B981; background: #ECFDF5; }
    .trend.down { color: #EF4444; background: #FEF2F2; }
    
    .stat-body p { font-size: 13px; color: #64748B; font-weight: 600; }
    .stat-body h3 { font-size: 24px; font-weight: 800; margin-top: 4px; }

    .bottom-section { display: grid; grid-template-columns: 2fr 1fr; gap: 30px; }
    .content-box { background: white; padding: 25px; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .box-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .box-header h3 { font-size: 16px; font-weight: 800; }

    .activity-item { display: flex; align-items: center; gap: 15px; padding: 12px 0; border-bottom: 1px solid #F1F5F9; }
    .activity-item:last-child { border: none; }
    .act-avatar { width: 40px; height: 40px; border-radius: 50%; background: #F1F5F9; }
    .act-info { flex-grow: 1; }
    .act-info p { font-size: 13px; font-weight: 600; }
    .act-info span { font-size: 11px; color: #94A3B8; }
    .act-points { text-align: right; font-weight: 700; font-size: 13px; }

    .top-siswa-card { background: white; padding: 25px; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .top-siswa-item { display: flex; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #F1F5F9; }
    .top-siswa-item:last-child { border: none; }
    .rank { font-weight: 800; font-size: 14px; width: 25px; color: #64748B; }
    .top-info { flex-grow: 1; font-size: 13px; font-weight: 700; color: #1E293B; }
    .top-pts { font-size: 12px; font-weight: 700; color: #10B981; }
</style>
@endsection

@section('content')
<div class="welcome-card">
    <div>
        <h2>Halo, User ADMIN! 👋</h2>
        <p>Berikut adalah ringkasan aktivitas sistem SISPOINT hari ini.</p>
    </div>
    <div style="text-align: right;">
        <h4 style="font-weight: 800; letter-spacing: 1px;" class="uppercase">
            {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
        </h4>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-head">
            <div class="stat-icon" style="background: #DBEAFE; color: #2563EB;"><i class="fa-solid fa-users"></i></div>
            <span class="trend up">+12% <i class="fa-solid fa-arrow-up"></i></span>
        </div>
        <div class="stat-body">
            <p>Total Siswa</p>
            <h3>{{ number_format($totalSiswa) }}</h3>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-head">
            <div class="stat-icon" style="background: #FEF9C3; color: #EAB308;"><i class="fa-solid fa-user-tie"></i></div>
            <span class="trend up">+2% <i class="fa-solid fa-arrow-up"></i></span>
        </div>
        <div class="stat-body">
            <p>Total Guru & Staff</p>
            <h3>{{ number_format($totalGuru) }}</h3>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-head">
            <div class="stat-icon" style="background: #FEE2E2; color: #DC2626;"><i class="fa-solid fa-circle-exclamation"></i></div>
            <span class="trend down">-5% <i class="fa-solid fa-arrow-down"></i></span>
        </div>
        <div class="stat-body">
            <p>Pelanggaran Hari Ini</p>
            <h3>{{ $pelanggaranHariIni }}</h3>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-head">
            <div class="stat-icon" style="background: #ECFDF5; color: #10B981;"><i class="fa-solid fa-award"></i></div>
            <span class="trend up">+2% <i class="fa-solid fa-arrow-up"></i></span>
        </div>
        <div class="stat-body">
            <p>Prestasi Bulan Ini</p>
            <h3>{{ $prestasiBulanIni }}</h3>
        </div>
    </div>
</div>

<div class="bottom-section">
    <div class="content-box">
        <div class="box-header">
            <h3>Aktivitas Terbaru</h3>
            <a href="#" style="font-size: 12px; color: #6366F1; font-weight: 700; text-decoration: none;">Lihat Semua</a>
        </div>
        
        <div class="activity-item">
            <div class="act-avatar"></div>
            <div class="act-info">
                <p>Hafidzh <span>mencatat pelanggaran</span></p>
                <span>Merokok di kantin</span>
            </div>
            <div class="act-points" style="color: #EF4444;">-5 Point</div>
        </div>

        <div class="activity-item">
            <div class="act-avatar"></div>
            <div class="act-info">
                <p>Nayzilla <span>mencatat prestasi</span></p>
                <span>Juara 1 LKS Tingkat Provinsi</span>
            </div>
            <div class="act-points" style="color: #10B981;">+50 Point</div>
        </div>

        <div class="activity-item">
            <div class="act-avatar"></div>
            <div class="act-info">
                <p>Bu Turyani<span>mencatat pelanggaran</span></p>
                <span>Atribut tidak lengkap</span>
            </div>
            <div class="act-points" style="color: #EF4444;">-2 Point</div>
        </div>
    </div>

    <div class="top-siswa-card">
        <div class="box-header">
            <h3>Top Siswa</h3>
        </div>
        
        <div style="margin-bottom: 15px;">
            @forelse($topSiswa as $index => $siswa)
            <div class="top-siswa-item">
                <span class="rank">{{ $index + 1 }}</span>
                <span class="top-info">{{ $siswa->name }}</span>
                <span class="top-pts">{{ $siswa->point ?? 0 }} Pts</span>
            </div>
            @empty
            <p style="font-size: 13px; color: #94A3B8; text-align: center; padding: 10px 0;">Belum ada data siswa.</p>
            @endforelse
        </div>

        <a href="{{ route('leaderboard.index') }}" style="display: block; text-align: center; padding: 10px; background: #F8FAFC; border-radius: 12px; text-decoration: none; color: #1E293B; font-weight: 700; font-size: 13px;">Lihat Leaderboard</a>
    </div>
</div>
@endsection