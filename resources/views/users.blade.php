@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 35px;">
    <h2 style="font-size: 28px; font-weight: 800; color: #0F172A;">Manajemen Pengguna</h2>
    <p style="color: #64748B; font-size: 14px; margin-top: 5px; font-weight: 600;">Kelola hak akses dan akun pengguna sistem SISPOINT.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 40px;">
    <div style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
        <div style="width: 50px; height: 50px; background-color: #DBEAFE; color: #2563EB; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-user-shield"></i>
        </div>
        <div>
            <h4 style="font-size: 15px; font-weight: 800;">Guru BK</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Input pelanggaran & prestasi</p>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
        <div style="width: 50px; height: 50px; background-color: #FEF9C3; color: #EAB308; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-chalkboard-user"></i>
        </div>
        <div>
            <h4 style="font-size: 15px; font-weight: 800;">Wali Kelas</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Monitoring & laporan kelas</p>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
        <div style="width: 50px; height: 50px; background-color: #FEE2E2; color: #DC2626; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
            <h4 style="font-size: 15px; font-weight: 800;">Pengurus OSIS</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Bantu input data lapangan</p>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
        <div style="width: 50px; height: 50px; background-color: #FFEDD5; color: #EA580C; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
            <h4 style="font-size: 15px; font-weight: 800;">Siswa</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Lihat riwayat & leaderboard</p>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
        <div style="width: 50px; height: 50px; background-color: #DCFCE7; color: #16A34A; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-user-group"></i>
        </div>
        <div>
            <h4 style="font-size: 15px; font-weight: 800;">Orang Tua</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Pantau perkembangan anak</p>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
        <div style="width: 50px; height: 50px; background-color: #F1F5F9; color: #475569; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-user-gear"></i>
        </div>
        <div>
            <h4 style="font-size: 15px; font-weight: 800;">Admin</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Kelola seluruh sistem</p>
        </div>
    </div>
</div>

<div style="background: white; padding: 35px; border-radius: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.01);">
    <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin-bottom: 25px;">Daftar Pengguna Aktif</h3>
    
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">NAMA</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">USERNAME</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">ROLE</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px; text-align: center;">AKSI</th>
            </tr>
        </thead>
        <tbody style="color: #1E293B; font-size: 14px; font-weight: 600;">
            <tr style="border-bottom: 1px solid #E2E8F0;">
                <td style="padding: 20px;">Pak Hilal Muwahid, S.pd</td>
                <td style="padding: 20px; color: #64748B;">Hilal_wali</td>
                <td style="padding: 20px;"><span style="font-size: 12px; font-weight: 800;">Wali Kelas XI PPLG B</span></td>
                <td style="padding: 20px; text-align: center; font-size: 16px;">
                    <a href="#" style="color: #64748B; margin-right: 15px; text-decoration: none;"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="#" style="color: #64748B; text-decoration: none;"><i class="fa-regular fa-trash-can"></i></a>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid #E2E8F0;">
                <td style="padding: 20px;">Bu Dela, S.Pd</td>
                <td style="padding: 20px; color: #64748B;">Dela_wali</td>
                <td style="padding: 20px;"><span style="font-size: 12px; font-weight: 800;">WALI KELAS</span></td>
                <td style="padding: 20px; text-align: center; font-size: 16px;">
                    <a href="#" style="color: #64748B; margin-right: 15px; text-decoration: none;"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="#" style="color: #64748B; text-decoration: none;"><i class="fa-regular fa-trash-can"></i></a>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px;">Althamiera</td>
                <td style="padding: 20px; color: #64748B;">Altha_siswa</td>
                <td style="padding: 20px;"><span style="font-size: 12px; font-weight: 800;">SISWA</span></td>
                <td style="padding: 20px; text-align: center; font-size: 16px;">
                    <a href="#" style="color: #64748B; margin-right: 15px; text-decoration: none;"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="#" style="color: #64748B; text-decoration: none;"><i class="fa-regular fa-trash-can"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection