@extends('layouts.admin')

@section('styles')
<style>
    /* Header Box */
    .page-header-box {
        margin-bottom: 30px;
    }
    .page-header-box h2 { font-size: 26px; font-weight: 800; color: #0F172A; }
    .page-header-box p { color: #64748B; font-size: 14px; margin-top: 4px; font-weight: 600; text-align: center; }

    /* Top 3 Podium Grid */
    .podium-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        align-items: end;
        margin-bottom: 40px;
    }

    .podium-card {
        background: white;
        border-radius: 24px;
        padding: 30px 20px;
        text-align: center;
        border: 1px solid #EEF2F6;
        box-shadow: 0 4px 20px rgba(0,0,0,0.01);
        position: relative;
    }

    /* Pengaturan posisi podium: Juara 1 di tengah dan lebih tinggi */
    .podium-card.rank-1 { order: 2; transform: scale(1.05); border-color: #FCD34D; }
    .podium-card.rank-2 { order: 1; }
    .podium-card.rank-3 { order: 3; }

    /* Avatar & Badge */
    .avatar-wrapper {
        position: relative;
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
    }
    .avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        background: #F1F5F9;
    }
    .badge-icon {
        position: absolute;
        bottom: -4px;
        right: -4px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: white;
        border: 2px solid white;
    }
    .rank-1 .badge-icon { background: #F59E0B; }
    .rank-2 .badge-icon { background: #94A3B8; }
    .rank-3 .badge-icon { background: #B45309; }

    .student-name { font-size: 16px; font-weight: 800; color: #0F172A; margin-bottom: 2px; }
    .student-class { font-size: 12px; color: #94A3B8; font-weight: 700; text-transform: uppercase; margin-bottom: 15px; }

    /* Score Box Podium */
    .score-box {
        padding: 12px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 800;
    }
    .rank-1 .score-box { background: #FEF3C7; color: #D97706; }
    .rank-2 .score-box { background: #F1F5F9; color: #475569; }
    .rank-3 .score-box { background: #FFEDD5; color: #C2410C; }

    /* List Table Card untuk peringkat #4 ke bawah */
    .list-leaderboard-card {
        background: white;
        border-radius: 24px;
        padding: 30px;
        border: 1px solid #EEF2F6;
    }

    .leaderboard-table { width: 100%; border-collapse: collapse; text-align: left; }
    .leaderboard-table th {
        padding: 16px 20px;
        color: #94A3B8;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.8px;
        border-bottom: 1px solid #F1F5F9;
    }
    .leaderboard-table td { padding: 16px 20px; font-size: 14px; font-weight: 700; color: #1E293B; border-bottom: 1px solid #F8FAFC; vertical-align: middle; }
    .leaderboard-table tr:last-child td { border: none; }

    /* List Row Styles */
    .rank-number { color: #64748B; font-weight: 800; font-size: 14px; }
    .student-profile-inline { display: flex; align-items: center; gap: 12px; }
    .avatar-small { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
    .name-inline { color: #0F172A; font-weight: 800; }
    
    .badge-prestasi {
        color: #10B981;
        background: #D1FAE5;
        font-size: 12px;
        font-weight: 800;
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-block;
    }
</style>
@endsection

@section('content')
<div class="page-header-box" style="text-align: center;">
    <h2>Leaderboard Siswa</h2>
    <p>Penghargaan bagi siswa-siswi dengan pencapaian prestasi terbanyak di SMKN 1 Kota Bekasi.</p>
</div>

{{-- SECTION PODIUM TOP 3 --}}
<div class="podium-container">
    @foreach($topSiswa->take(3) as $index => $siswa)
        @php 
            $rank = $index + 1; 
        @php
        <div class="podium-card rank-{{ $rank }}">
            <div class="avatar-wrapper">
                {{-- Jika ada foto asli gunakan pathnya, jika tidak gunakan default avatar --}}
                <img src="{{ $siswa->avatar_url ? asset($siswa->avatar_url) : 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . $siswa->nama }}" class="avatar-img" alt="Avatar">
                <div class="badge-icon">
                    @if($rank == 1) <i class="fa-solid fa-crown"></i>
                    @else {{ $rank }} @endif
                </div>
            </div>
            <div class="student-name">{{ $siswa->nama }}</div>
            <div class="student-class">{{ $siswa->kelas }}</div>
            <div class="score-box">
                {{ $siswa->total_prestasi }} Prestasi
            </div>
        </div>
    @endforeach
</div>

{{-- SECTION DAFTAR PERINGKAT #4 KE BAWAH --}}
<div class="list-leaderboard-card">
    <table class="leaderboard-table">
        <thead>
            <tr>
                <th style="width: 15%;">RANK</th>
                <th style="width: 45%;">SISWA</th>
                <th style="width: 20%;">KELAS</th>
                <th style="width: 20%; text-align: right;">TOTAL PRESTASI</th>
            </tr>
        </thead>
        <tbody>
            @if($topSiswa->count() > 3)
                @foreach($topSiswa->slice(3) as $index => $siswa)
                <tr>
                    <td class="rank-number">#{{ $index + 1 }}</td>
                    <td>
                        <div class="student-profile-inline">
                            <img src="{{ $siswa->avatar_url ? asset($siswa->avatar_url) : 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . $siswa->nama }}" class="avatar-small" alt="">
                            <span class="name-inline">{{ $siswa->nama }}</span>
                        </div>
                    </td>
                    <td style="color: #475569; text-transform: uppercase;">{{ $siswa->kelas }}</td>
                    <td style="text-align: right;">
                        <span class="badge-prestasi">{{ $siswa->total_prestasi }} Prestasi</span>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="text-align: center; color: #94A3B8; padding: 30px;">
                        Belum ada data peringkat tambahan.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection