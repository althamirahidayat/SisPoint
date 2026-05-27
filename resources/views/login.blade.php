<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SISPOINT</title>
    
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        /* Tombol Kembali ke Beranda */
        .btn-back {
            position: absolute;
            top: 40px;
            left: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #0F172A;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: transform 0.2s ease;
        }

        .btn-back:hover {
            transform: translateX(-4px);
        }

        /* Container Utama */
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        /* Logo Brand atas Card */
        .login-logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 25px;
        }

        /* Card Box */
        .login-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid #E2E8F0;
        }

        /* Header Gelap Card */
        .card-header-dark {
            background-color: #0B192C; /* Navy gelap sesuai mockup */
            padding: 24px;
            color: white;
        }

        .card-header-dark h2 {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .card-header-dark p {
            font-size: 12px;
            color: #94A3B8;
            font-weight: 600;
        }

        /* Form Body */
        .card-body {
            padding: 40px 30px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 800;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #0F172A;
            background-color: white;
            border: 1.5px solid #BFDBFE; /* Border biru muda sesuai gambar */
            border-radius: 12px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input::placeholder {
            color: #94A3B8;
            font-weight: 600;
        }

        .form-input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Tombol Masuk */
        .btn-masuk {
            width: 100%;
            background-color: #2563EB;
            color: white;
            border: none;
            padding: 14px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        .btn-masuk:hover {
            background-color: #1D4ED8;
            transform: translateY(-1px);
        }

        /* Responsive untuk HP */
        @media (max-width: 480px) {
            .btn-back {
                top: 20px;
                left: 20px;
            }
            body {
                align-items: flex-start;
                padding-top: 100px;
            }
            .card-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <a href="/landing" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
    </a>

    <div class="login-wrapper">
        <img src="/images/sispoint.png" alt="Logo SISPOINT" class="login-logo">

        <div class="login-card">
            <div class="card-header-dark">
                <h2>Selamat Datang!</h2>
                <p>Masuk ke sistem SISPOINT SMKN 1 Bekasi</p>
            </div>

            <div class="card-body">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-input" placeholder="" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-input" placeholder="" required>
                    </div>

                    <button type="submit" class="btn-masuk">Masuk</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>