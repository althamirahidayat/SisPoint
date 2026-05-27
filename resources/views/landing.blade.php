<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISPOINT - SMKN 1 Kota Bekasi</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #F8FAFC;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* NAVBAR */
        .navbar {
            display: flex;
            align-items: center;
            padding: 20px 0;
            margin-bottom: 40px;
        }

    .logo-sispoint .brand-img {
    max-width: 250px; /* Silakan sesuaikan ukuran pixel-nya di sini */
    width: 100%;
    height: auto;
    display: block;
}


        /* HERO SECTION */
        .hero-section {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: center;
            margin-bottom: 60px;
        }

        .hero-text h1 {
            font-size: 44px;
            font-weight: 800;
            color: #0F172A;
            line-height: 1.2;
            margin-bottom: 20px;
            margin-top: -50px;
        }

        .hero-text h1 span {
            color: #10B981; /* Warna Hijau Disiplin */
        }

        .hero-text p {
            font-size: 16px;
            color: #64748B;
            line-height: 1.6;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .btn-mulai {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: #2563EB;
            color: white;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            transition: all 0.2s ease;
        }

        .btn-mulai:hover {
            background-color: #1D4ED8;
            transform: translateY(-2px);
        }

        .hero-image {
            display: flex;
            justify-content: center;
        }

        .hero-image img {
            max-width: 320px;
            width: 100%;
            height: auto;
            margin-top: -80px;
        }

        /* FEATURES SECTION */
        .features-section {
            background-color: #EDF2F7; /* Background abu-abu muda */
            border-radius: 32px;
            padding: 60px 40px;
        }

        .features-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .features-header h2 {
            font-size: 32px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 10px;
        }

        .features-header p {
            color: #64748B;
            font-weight: 600;
            font-size: 15px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: white;
            padding: 35px 25px;
            border-radius: 24px;
            border: 1px solid #EEF2F6;
            box-shadow: 0 4px 20px rgba(0,0,0,0.01);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background-color: #DBEAFE;
            color: #2563EB;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 12px;
        }

        .feature-card p {
            font-size: 13px;
            color: #64748B;
            line-height: 1.6;
            font-weight: 600;
        }

        /* Responsive Layout */
        @media (max-width: 991px) {
            .hero-section {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .hero-text h1 {
                font-size: 36px;
            }
            .hero-image {
                order: -1;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <header class="navbar">
        <div class="logo-sispoint">
    <img src="/images/sispoint.png" alt="Logo SISPOINT" class="brand-img">
</div>
    </header>

    <section class="hero-section">
        <div class="hero-text">
            <h1>Bersama Membangun <br><span>Disiplin dan Prestasi</span> <br>Siswa.</h1>
            <p>SISPOINT membantu SMKN 1 Kota Bekasi mengelola poin pelanggaran dan apresiasi prestasi siswa secara real-time untuk menciptakan lingkungan sekolah yang disiplin dan kompetitif.</p>
            <a href="login" class="btn-mulai">Mulai Sekarang <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="hero-image">
            <img src="/images/logosmkn1.png" alt="Logo Smkn1" class="brand-img">
        </div>
    </section>

    <section class="features-section">
        <div class="features-header">
            <h2>Fitur Utama Sistem</h2>
            <p>Dirancang untuk memudahkan seluruh elemen sekolah dalam memantau perkembangan karakter siswa.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                <h3>Pencatatan Real-time</h3>
                <p>Pelanggaran dan apresiasi siswa dapat dicatat langsung oleh pihak berwenang untuk memastikan data tercatat cepat dan akurat.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-trophy"></i></div>
                <h3>Leaderboard Prestasi</h3>
                <p>Sistem ranking otomatis untuk memotivasi siswa dalam meraih prestasi sebanyak-banyaknya.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-user-shield"></i></div>
                <h3>Monitoring Orang Tua</h3>
                <p>Orang tua dapat memantau riwayat pelanggaran dan apresiasi anak secara transparan.</p>
            </div>
        </div>
    </section>
</div>

</body>
</html>