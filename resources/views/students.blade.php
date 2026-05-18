@extends('layouts.admin')

@section('styles')
<style>
    .page-title-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    .page-title-box h2 { font-size: 26px; font-weight: 800; color: #0F172A; }
    .page-title-box p { color: #64748B; font-size: 14px; margin-top: 4px; font-weight: 600; }

    .btn-group { display: flex; gap: 12px; }
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 700;
        border-radius: 12px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-outline { background: white; color: #475569; border: 1px solid #CBD5E1; }
    .btn-outline:hover { background: #F8FAFC; }
    .btn-primary { background: #6366F1; color: white; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2); }
    .btn-primary:hover { background: #4F46E5; }

    /* CARD BOX UTAMA */
    .table-container {
        background: white;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.01);
        border: 1px solid #EEF2F6;
    }

    /* FILTER BAR SECTION */
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }
    .inner-search {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        padding: 10px 18px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        max-width: 400px;
    }
    .inner-search input { background: none; border: none; outline: none; width: 100%; font-size: 13px; font-weight: 600; }
    
    .select-filter {
        background: white;
        border: 1px solid #E2E8F0;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    /* TABLE LAYOUT */
    .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
    .custom-table th {
        padding: 16px 20px;
        color: #94A3B8;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.8px;
        border-bottom: 1px solid #F1F5F9;
    }
    .custom-table td { padding: 18px 20px; font-size: 14px; font-weight: 700; color: #1E293B; border-bottom: 1px solid #F8FAFC; }
    .custom-table tr:last-child td { border: none; }

    .nis-text { color: #000000; font-weight: 800; }
    .student-name { display: flex; align-items: center; gap: 12px; }
    .student-icon {
        width: 30px; height: 30px; background: #F1F5F9; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; color: #64748B; font-size: 12px;
    }

    /* BADGE CHIPS POIN & PRESTASI */
    .badge-poin { font-size: 11px; font-weight: 800; color: #64748B; background: #F1F5F9; padding: 4px 10px; border-radius: 8px; }
    .badge-poin.danger { color: #EA580C; background: #FFEDD5; } /* Highlight untuk poin tinggi */
    
    .text-prestasi { color: #10B981; font-weight: 800; font-size: 12px; letter-spacing: 0.3px; }

    /* PAGINATION SECTION */
    .pagination-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #F1F5F9;
        color: #94A3B8;
        font-size: 13px;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="page-title-box">
    <div>
        <h2>Data Siswa</h2>
        <p>Manajemen data seluruh siswa SMKN 1 Kota Bekasi.</p>
    </div>
    <div class="btn-group">
        <button class="btn-action btn-outline"><i class="fa-solid fa-download"></i> Unduh Laporan</button>
        <button class="btn-action btn-primary"><i class="fa-solid fa-plus"></i> Tambah Siswa</button>
    </div>
</div>

<div class="table-container">
    
    <div class="filter-bar">
        <div class="inner-search">
            <i class="fa-solid fa-magnifying-glass" style="color: #94A3B8; font-size: 13px;"></i>
            <input type="text" placeholder="Cari NIS atau nama siswa...">
        </div>
        <button class="select-filter">
            <i class="fa-solid fa-sliders"></i> Semua Kelas
        </button>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th style="width: 15%;">NIS</th>
                <th style="width: 30%;">NAMA LENGKAP</th>
                <th style="width: 15%;">KELAS</th>
                <th style="width: 20%;">POIN PELANGGARAN</th>
                <th style="width: 15%;">TOTAL PRESTASI</th>
                <th style="width: 5%; text-align: center;">AKSI</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="nis-text">21221001</td>
                <td>
                    <div class="student-name">
                        <div class="student-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        <span>Althamira</span>
                    </div>
                </td>
                <td style="color: #475569;">XI RPL B</td>
                <td><span class="badge-poin">15 POIN</span></td>
                <td><span class="text-prestasi">3 PRESTASI</span></td>
                <td style="text-align: center; color: #94A3B8; cursor: pointer;"><i class="fa-solid fa-ellipsis-vertical"></i></td>
            </tr>
            <tr>
                <td class="nis-text">21221002</td>
                <td>
                    <div class="student-name">
                        <div class="student-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        <span>Savira</span>
                    </div>
                </td>
                <td style="color: #475569;">XII RPL A</td>
                <td><span class="badge-poin">0 POIN</span></td>
                <td><span class="text-prestasi">8 PRESTASI</span></td>
                <td style="text-align: center; color: #94A3B8; cursor: pointer;"><i class="fa-solid fa-ellipsis-vertical"></i></td>
            </tr>
            <tr>
                <td class="nis-text">21221003</td>
                <td>
                    <div class="student-name">
                        <div class="student-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        <span>Ganis ALya</span>
                    </div>
                </td>
                <td style="color: #475569;">XII TKJ A</td>
                <td><span class="badge-poin">5 POIN</span></td>
                <td><span class="text-prestasi">12 PRESTASI</span></td>
                <td style="text-align: center; color: #94A3B8; cursor: pointer;"><i class="fa-solid fa-ellipsis-vertical"></i></td>
            </tr>
            <tr>
                <td class="nis-text">21221004</td>
                <td>
                    <div class="student-name">
                        <div class="student-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        <span>Fitrianisya</span>
                    </div>
                </td>
                <td style="color: #475569;">XI DKV B</td>
                <td><span class="badge-poin danger">25 POIN</span></td>
                <td><span class="text-prestasi">1 PRESTASI</span></td>
                <td style="text-align: center; color: #94A3B8; cursor: pointer;"><i class="fa-solid fa-ellipsis-vertical"></i></td>
            </tr>
            <tr>
                <td class="nis-text">21221005</td>
                <td>
                    <div class="student-name">
                        <div class="student-icon"><i class="fa-solid fa-user-graduate"></i></div>
                        <span>Ammar Rahman</span>
                    </div>
                </td>
                <td style="color: #475569;">X TKR B</td>
                <td><span class="badge-poin">0 POIN</span></td>
                <td><span class="text-prestasi">5 PRESTASI</span></td>
                <td style="text-align: center; color: #94A3B8; cursor: pointer;"><i class="fa-solid fa-ellipsis-vertical"></i></td>
            </tr>
        </tbody>
    </table>

    <div class="pagination-box">
        <div>Menampilkan 5 dari 2,450 siswa</div>
        <div class="btn-group">
            <button class="btn-action btn-outline" style="padding: 8px 14px; font-size: 12px;">Sebelumnya</button>
            <button class="btn-action btn-outline" style="padding: 8px 14px; font-size: 12px;">Selanjutnya</button>
        </div>
    </div>

</div>
@endsection