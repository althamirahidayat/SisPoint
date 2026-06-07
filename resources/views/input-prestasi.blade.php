@extends('layouts.admin')

@section('styles')
<style>
    /* Styling Komponen Form SisPoint */
    .page-header-box { margin-bottom: 24px; }
    .page-header-box h2 { font-size: 24px; font-weight: 700; color: #1E293B; margin-bottom: 4px; }
    .page-header-box p { color: #64748B; font-size: 14px; }

    .custom-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        margin-bottom: 24px;
        padding: 32px;
    }

    .card-accent-yellow { border-left: 5px solid #FACC15; }

    .card-header-title {
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .label-custom {
        display: block;
        font-size: 11px;
        font-weight: 800;
        color: #64748B;
        text-transform: uppercase;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
    }

    .form-control-custom {
        display: block;
        width: 100%;
        border-radius: 10px;
        border: 1px solid #E2E8F0;
        padding: 14px 16px;
        font-size: 14px;
        font-weight: 500;
        color: #1E293B;
        transition: all 0.2s;
        box-sizing: border-box;
        background-color: #FFF;
    }

    .form-control-custom:focus {
        border-color: #6366F1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Container Baris Murid */
    .winner-row-box {
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 20px;
        background: #FFFFFF;
    }

    /* Grid layout sejajar mendatar */
    .winner-grid-layout {
        display: grid;
        grid-template-columns: 2fr 1.5fr 0.8fr auto;
        gap: 20px;
        align-items: end;
    }

    .btn-add-winner {
        background: #6366F1;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-trash-outline {
        border: 1px solid #E2E8F0;
        background: white;
        border-radius: 10px;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94A3B8;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-trash-outline:hover {
        color: #EF4444;
        border-color: #FEE2E2;
        background: #FEF2F2;
    }

    .alert-custom {
        background: #E8F5E9;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        gap: 12px;
        color: #2E7D32;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 500;
        align-items: center;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-top: 40px;
        margin-bottom: 60px;
    }

    .btn-save {
        background: #6366F1;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 14px 40px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-cancel {
        background: white;
        color: #1E293B;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 14px 40px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<div class="container py-2" style="max-width: 1100px;">
    
    <div class="page-header-box">
        <h2>Input Prestasi Siswa</h2>
        <p>Catat perlombaan yang diikuti dan rincian para pemenang perwakilan SMKN 1.</p>
    </div>

    <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- CARD 1: RINCIAN PERLOMBAAN --}}
        <div class="custom-card card-accent-yellow">
            <div class="card-header-title text-warning" style="color: #EAB308 !important;">
                🏆 RINCIAN PERLOMBAAN
            </div>
            
            <div class="row mb-4">
                <div class="col-12">
                    <label class="label-custom">NAMA LENGKAP PERLOMBAAN / KEJUARAAN</label>
                    <input type="text" name="nama_lomba" class="form-control-custom" placeholder="Contoh: Lomba Robotik Nasional RISTEKDIKTI Ke-5" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-7">
                    <label class="label-custom">KATEGORI PEMBIDANGAN</label>
                    <select name="kategori" class="form-control-custom" required>
                        <option value="AKADEMIK">AKADEMIK (Sains, Teknologi, Mapel, LKS)</option>
                        <option value="NON-AKADEMIK">NON-AKADEMIK (Olahraga, Seni, Pramuka, Ekskul)</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="label-custom">TANGGAL PENGUMUMAN / JUARA</label>
                    <input type="date" name="tanggal_pengumuman" class="form-custom form-control-custom" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label class="label-custom">LAMPIRAN / CATATAN DOKUMENTASI (OPSIONAL)</label>
                    <input type="file" name="lampiran" class="form-control-custom">
                    <div style="font-size: 12px; color: #94A3B8; margin-top: 8px;">
                        Misal: Sertifikat No: 203/SK-Kemendikbud/2026 atau tautan Google Drive dokumentasi foto-foto podium.
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 2: DAFTAR MURID --}}
        <div class="custom-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="card-header-title text-primary" style="color: #6366F1 !important; margin-bottom: 0;">
                    👤 DAFTAR MURID PEMENANG (JUARA)
                </div>
                <button type="button" id="btn-add-winner" class="btn-add-winner" onclick="gandakanForm(event)">
                    + Tambah Pemenang
                </button>
            </div>

            {{-- DATALIST: DETEKSI KELAS OTOMATIS AMAN --}}
            <datalist id="list-siswa-kompetisi">
                @foreach($allUsers as $siswa)
                    @php
                        $namaKelas = 'Siswa';
                        if ($siswa->siswa) {
                            $namaKelas = $siswa->siswa->kelas ?? $siswa->siswa->nama_kelas ?? $siswa->siswa->id_kelas ?? 'Siswa';
                        }
                    @endphp
                    <option value="{{ $siswa->name }} - {{ $namaKelas }}" data-id="{{ $siswa->id }}"></option>
                @endforeach
            </datalist>

            <div id="winners-container">
                {{-- BARIS PEMENANG 1 --}}
                <div class="winner-row-box">
                    <div class="winner-grid-layout">
                        
                        <div>
                            <label class="label-custom label-nomor-siswa">PILIH SISWA (1)</label>
                            <input type="text" list="list-siswa-kompetisi" class="form-control-custom input-nama-ketik" placeholder="-- Pilih Siswa --" required>
                            <input type="hidden" name="siswa_id[]" class="hidden-siswa-id">
                        </div>

                        <div>
                            <label class="label-custom">KEMENANGAN / POSISI</label>
                            <select name="kemenangan[]" class="form-control-custom" required>
                                <option value="Juara 1 (Emas)">Juara 1 (Emas)</option>
                                <option value="Juara 2 (Perak)">Juara 2 (Perak)</option>
                                <option value="Juara 3 (Perunggu)">Juara 3 (Perunggu)</option>
                                <option value="Harapan">Juara Harapan</option>
                            </select>
                        </div>

                        <div>
                            <label class="label-custom">POIN TAMBAHAN</label>
                            <input type="number" name="poin_tambahan[]" class="form-control-custom text-center" value="50" style="color: #10B981; font-weight: 800;">
                        </div>

                        <div>
                            {{-- Tombol sampah disembunyikan di baris pertama --}}
                            <button type="button" class="btn-trash-outline btn-remove-row" style="visibility: hidden;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="alert-custom mt-4">
                <div style="font-size: 16px;">✓</div>
                <div>
                    Kemenangan ini akan langsung menambah riwayat kompetensi dan keaktifan pada masing-masing murid yang dipilih. Poin rapor yang ditambahkan akan secara instan memperbarui peringkat mereka pada halaman Leaderboard Global.
                </div>
            </div>
        </div>

        {{-- BUTTONS ACTION --}}
        <div class="action-buttons">
            <a href="{{ url()->previous() }}" class="btn-cancel">✕ Batal & Kembali</a>
            <button type="submit" class="btn-save">Simpan Prestasi Kompetisi</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // 1. Fungsi sinkronisasi ketik ke hidden ID
    function pasangLogikaKetik(rowElement) {
        const inputKetik = rowElement.querySelector('.input-nama-ketik');
        const hiddenId = rowElement.querySelector('.hidden-siswa-id');
        const datalist = document.getElementById('list-siswa-kompetisi');

        if (inputKetik && datalist) {
            inputKetik.addEventListener('input', function() {
                const pilihan = Array.from(datalist.options).find(option => option.value === this.value);
                hiddenId.value = pilihan ? pilihan.getAttribute('data-id') : "";
            });
        }
    }

    // 2. Fungsi update nomor urut
    function perbaruiNomorLabel() {
        const labels = document.querySelectorAll('.label-nomor-siswa');
        labels.forEach((label, index) => {
            label.textContent = `PILIH SISWA (${index + 1})`;
        });
    }

    // Jalankan logika untuk baris pertama saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const firstRow = document.querySelector('.winner-row-box');
        if (firstRow) pasangLogikaKetik(firstRow);
    });

    // 3. FUNGSI UTAMA DUPLIKASI (Versi Aman)
    function gandakanForm(e) {
        if (e) e.preventDefault();
        
        const container = document.getElementById('winners-container');
        const firstRow = document.querySelector('.winner-row-box');
        
        if (!firstRow) return;

        // Clone baris pertama
        const newRow = firstRow.cloneNode(true);

        // Bersihkan nilai di baris baru
        newRow.querySelector('.input-nama-ketik').value = "";
        newRow.querySelector('.hidden-siswa-id').value = "";
        newRow.querySelector('select[name="kemenangan[]"]').value = "Juara 1 (Emas)";
        newRow.querySelector('input[name="poin_tambahan[]"]').value = "50";
        
        // Munculkan tombol hapus
        const deleteBtn = newRow.querySelector('.btn-remove-row');
        if (deleteBtn) {
            deleteBtn.style.visibility = 'visible';
            deleteBtn.onclick = function() {
                newRow.remove();
                perbaruiNomorLabel();
            };
        }

        container.appendChild(newRow);
        pasangLogikaKetik(newRow);
        perbaruiNomorLabel();
    }
</script>
@endsection