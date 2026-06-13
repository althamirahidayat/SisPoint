<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISPOINT - SMKN 1 KOTA BEKASI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; background-color: #F8FAFC; min-height: 100vh; color: #1E293B; }

        /* SIDEBAR LIGHT STYLE */
        .sidebar {
            width: 260px;
            background-color: white;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #E2E8F0;
            position: fixed;
            height: 100vh;
            z-index: 10;
        }

        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 40px; padding-left: 10px; }
        .brand-logo { 
            width: 35px; height: 35px; background: #1E293B; border-radius: 10px; 
            display: flex; align-items: center; justify-content: center; color: white; font-size: 18px;
        }
        .brand-name { color: #1E293B; font-weight: 800; font-size: 18px; }
        .brand-sub { font-size: 10px; color: #64748B; font-weight: 700; display: block; margin-top: -2px; }

        .nav-menu { list-style: none; flex-grow: 1; }
        .nav-item { margin-bottom: 6px; }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 18px;
            text-decoration: none;
            color: #64748B;
            font-size: 14px;
            font-weight: 700;
            border-radius: 12px;
            transition: 0.2s;
        }

        /* State Menu Aktif (Warna Ungu Figma) */
        .nav-link:hover { background: #F1F5F9; color: #1E293B; }
        .nav-link.active { background: #6366F1; color: white; }
        .nav-link.active i { color: white; }

        .logout { color: #EF4444; margin-top: auto; border-top: 1px solid #E2E8F0; padding-top: 20px; border-radius: 0; }
        .logout:hover { background: #FEF2F2; color: #DC2626; }

        /* CONTAINER */
        .main-container { flex: 1; margin-left: 260px; display: flex; flex-direction: column; background: #FAFBFD; min-height: 100vh; }

        /* TOP HEADER */
        header {
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            border-bottom: 1px solid #E2E8F0;
        }

        .search-bar {
            background: #F1F5F9;
            padding: 10px 20px;
            border-radius: 12px;
            width: 380px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search-bar input { background: none; border: none; outline: none; width: 100%; font-size: 14px; color: #1E293B; }

        .user-profile { display: flex; align-items: center; gap: 12px; }
        .user-info { text-align: right; }
        .user-info h4 { font-size: 14px; font-weight: 800; color: #1E293B; }
        .user-info span { font-size: 11px; color: #94A3B8; font-weight: 700; letter-spacing: 0.5px; }
        
        /* Avatar Sepuh Guru */
        .avatar { 
            width: 42px; height: 42px; border-radius: 50%; background: #E2E8F0;
            display: flex; align-items: center; justify-content: center; font-size: 24px; border: 1px solid #CBD5E1;
        }

        .content-body { padding: 35px 40px; }
    </style>
    @yield('styles')
</head>
<body>

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-logo"><i class="fa-solid fa-graduation-cap"></i></div>
            <div>
                <span class="brand-name">SISPOINT</span>
                <span class="brand-sub">SMKN 1 KOTA BEKASI</span>
            </div>
        </div>
        <ul class="nav-menu">

<li class="nav-item">
    <a href="{{ route('dashboard.siswa') }}" class="nav-link {{ Request::is('dashboardSiswa*') ? 'active' : '' }}">
        <i class="fa-solid fa-chart-pie"></i> Dashboard
    </a>
</li>

<li class="nav-item">
<a href="{{ route('siswa.jenis-pelanggaran') }}"
   class="nav-link {{ Request::routeIs('siswa.jenis-pelanggaran') ? 'active' : '' }}">
    <i class="fa-solid fa-shield-halved"></i>
    Jenis Pelanggaran
</a>
</li>

<li class="nav-item">
    <a href="{{ url('/apresiasi') }}" class="nav-link {{ Request::is('apresiasi*') ? 'active' : '' }}">
        <i class="fa-solid fa-award"></i> Jenis Apresiasi
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('leaderboard.index') }}" class="nav-link {{ Request::is('leaderboard*') ? 'active' : '' }}">
        <i class="fa-solid fa-ranking-star"></i> Leaderboard
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Saya
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="fa-solid fa-user"></i> Profil Saya
    </a>
</li>

</ul>
        
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="nav-link logout" style="border:none;background:none;width:100%;cursor:pointer;text-align:left;">
        <i class="fa-solid fa-right-from-bracket"></i> Keluar
    </button>
</form>
    </aside>

    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
    @csrf
    <button type="submit" style="background: none; border: none; color: #DC2626; cursor: pointer; font-weight: 700;">
        🚪 Keluar
    </button>
</form>

    <div class="main-container">
        <header>
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass" style="color: #94A3B8;"></i>
                <input type="text" placeholder="Cari siswa, laporan, atau fitur...">
            </div>
            <div class="user-profile">
                <div class="user-info">
                <h4>{{ $siswa->nama_lengkap ?? Auth::user()->name }}</h4>
                <span>SISWA</span>
                </div>
                <div class="avatar">🎓</div>
            </div>
        </header>

        <main class="content-body">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
</html>