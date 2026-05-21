@extends('layouts.admin')

@section('styles')
<style>
    /* --- Layout Header & Base Styles --- */
    .page-header-box { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .page-header-box h2 { font-size: 28px; font-weight: 800; color: #0F172A; }
    .page-header-box p { color: #64748B; font-size: 14px; margin-top: 4px; font-weight: 600; }

    .btn-primary-custom {
        background: #4F46E5; color: white; padding: 12px 24px; font-size: 14px; font-weight: 700;
        border-radius: 12px; text-decoration: none; border: none; display: inline-flex;
        align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        cursor: pointer; transition: 0.2s;
    }
    .btn-primary-custom:hover { background: #4338CA; }

    /* --- Info Grid Modern (Sesuai Gambar 1) --- */
    .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; margin-bottom: 35px; }
    .info-card { background: white; border-radius: 20px; padding: 25px; display: flex; gap: 20px; border: 1px solid #E2E8F0; position: relative; }
    .info-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; border-radius: 20px 0 0 20px; }
    .info-card.orange::before { background: #F59E0B; }
    .info-card.indigo::before { background: #6366F1; }
    
    .info-icon-box { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .info-card.orange .info-icon-box { background: #FEF3C7; color: #D97706; }
    .info-card.indigo .info-icon-box { background: #E0E7FF; color: #4F46E5; }
    
    .info-text-box h4 { font-size: 15px; font-weight: 800; color: #1E293B; margin-bottom: 6px; }
    .info-text-box p { font-size: 13px; color: #64748B; font-weight: 600; line-height: 1.6; }

    /* --- Table Card & Filter Bar (Sesuai Gambar 2) --- */
    .main-table-card { background: white; border-radius: 24px; padding: 30px; border: 1px solid #EEF2F6; box-shadow: 0 4px 20px rgba(0,0,0,0.01); }
    
    .filter-bar { display: flex; gap: 15px; margin-bottom: 25px; }
    .search-wrapper { position: relative; flex-grow: 1; }
    .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94A3B8; }
    .search-input { width: 100%; padding: 12px 16px 12px 45px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; font-size: 14px; font-weight: 600; outline: none; }
    
    .btn-filter {
        background: white; border: 1px solid #E2E8F0; padding: 12px 20px; font-size: 14px; font-weight: 700;
        color: #475569; border-radius: 12px; display: inline-flex; align-items: center; gap: 8px; cursor: pointer;
    }

    .violation-table { width: 100%; border-collapse: collapse; text-align: left; }
    .violation-table th { padding: 16px 20px; color: #94A3B8; font-size: 11px; font-weight: 800; letter-spacing: 0.8px; border-bottom: 1px solid #F1F5F9; text-transform: uppercase; }
    .violation-table td { padding: 18px 20px; font-size: 14px; font-weight: 700; color: #1E293B; border-bottom: 1px solid #F8FAFC; }

    /* --- Badge Kategori Apresiasi --- */
    .badge-cat { font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 6px; display: inline-block; text-transform: uppercase; }
    .badge-cat.akademik, .badge-cat.AKADEMIK { color: #4F46E5; background: #E0E7FF; }
    .badge-cat.non-akademik, .badge-cat.NON-AKADEMIK { color: #D97706; background: #FEF3C7; }

    .status-online { display: inline-flex; align-items: center; gap: 8px; font-size: 12px; color: #10B981; font-weight: 700; }
    .status-dot { width: 7px; height: 7px; background-color: #10B981; border-radius: 50%; }

    .action-links button, .action-links a { background: none; border: none; text-decoration: none; font-size: 12px; font-weight: 800; margin-left: 12px; cursor: pointer; padding: 0; }
    .link-edit { color: #6366F1; }
    .link-hapus { color: #EF4444; }

    /* --- Styles Modal Popup --- */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); backdrop-filter: blur(4px); z-index: 9999; align-items: center; justify-content: center; }
    .modal-content { background: white; width: 100%; max-width: 450px; padding: 30px; border-radius: 24px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); animation: modalFadeIn 0.3s ease; }
    @keyframes modalFadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    .modal-header { margin-bottom: 20px; }
    .modal-header h3 { font-size: 18px; font-weight: 800; color: #0F172A; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; font-size: 12px; font-weight: 700; color: #64748B; margin-bottom: 8px; }
    .form-control { width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid #E2E8F0; font-size: 14px; font-weight: 600; outline: none; }
    .form-control:focus { border-color: #6366F1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }
    .modal-footer { display: flex; justify-content: flex-end; gap: 12px; margin-top: 25px; }
    .btn-cancel { background: #F1F5F9; color: #475569; padding: 12px 20px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }
    .btn-save { background: #6366F1; color: white; padding: 12px 20px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }
</style>
@endsection

@section('content')
<div class="page-header-box">
    <div>
        <h2>Jenis Apresiasi</h2>
        <p>Daftar referensi poin prestasi dan apresiasi siswa SMKN 1 Kota Bekasi.</p>
    </div>
    <button class="btn-primary-custom" onclick="openModal('modalTambah')">
        <i class="fa-solid fa-plus"></i> Tambah Jenis
    </button>
</div>

<div class="info-grid">
    <div class="info-card orange">
        <div class="info-icon-box"><i class="fa-solid fa-star"></i></div>
        <div class="info-text-box">
            <h4>Apresiasi Siswa</h4>
            <p>Setiap prestasi yang diraih siswa akan menambah poin kedisiplinan dan memberikan dampak positif pada rapor karakter.</p>
        </div>
    </div>
    <div class="info-card indigo">
        <div class="info-icon-box"><i class="fa-solid fa-award"></i></div>
        <div class="info-text-box">
            <h4>Kategori Prestasi</h4>
            <p>Prestasi dibagi menjadi dua kategori utama: Akademik (Lomba Mapel, LKS) dan Non-Akademik (Olahraga, Seni, Organisasi).</p>
        </div>
    </div>
</div>

<div class="main-table-card">
    <div class="filter-bar">
        <div class="search-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" class="search-input" placeholder="Cari jenis apresiasi...">
        </div>
        <button class="btn-filter">
            <i class="fa-solid fa-sliders"></i> Filter Kategori
        </button>
    </div>

    <table class="violation-table">
        <thead>
            <tr>
                <th style="width: 40%;">NAMA APRESIASI</th>
                <th style="width: 20%;">KATEGORI</th>
                <th style="width: 15%;">POIN TAMBAHAN</th>
                <th style="width: 12%;">STATUS</th>
                <th style="width: 13%; text-align: right;">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appreciations as $item)
            <tr>
                <td style="color: #0F172A; font-weight: 800;">{{ $item->name }}</td>
                <td><span class="badge-cat {{ strtolower($item->category) }}">{{ $item->category }}</span></td>
                <td style="color: #10B981;">+{{ $item->points }} Poin</td>
                <td>
                    <div class="status-online"><span class="status-dot"></span> {{ $item->is_active ? 'AKTIF' : 'NON-AKTIF' }}</div>
                </td>
                <td class="action-links" style="text-align: right;">
                    <button type="button" class="link-edit" 
                        onclick="openEditModal('{{ $item->id }}', '{{ $item->name }}', '{{ $item->points }}', '{{ $item->category }}')">
                        Edit
                    </button>
                    
                    <form action="{{ route('appreciation-categories.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="link-hapus" onclick="return confirm('Yakin ingin menghapus data apresiasi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #94A3B8; padding: 30px 0;">Belum ada data referensi jenis apresiasi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="modalTambah" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Jenis Apresiasi</h3>
        </div>
        <form action="{{ route('appreciation-categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>NAMA APRESIASI</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Juara 1 Lomba Olahraga" required>
            </div>
            <div class="form-group">
                <label>JUMLAH POIN</label>
                <input type="number" name="points" class="form-control" placeholder="Contoh: 40" required>
            </div>
            <div class="form-group">
                <label>KATEGORI</label>
                <select name="category" class="form-control">
                    <option value="AKADEMIK">AKADEMIK</option>
                    <option value="NON-AKADEMIK">NON-AKADEMIK</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn-save">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Jenis Apresiasi</h3>
        </div>
        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>NAMA APRESIASI</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>JUMLAH POIN</label>
                <input type="number" name="points" id="edit_points" class="form-control" required>
            </div>
            <div class="form-group">
                <label>KATEGORI</label>
                <select name="category" id="edit_category" class="form-control">
                    <option value="AKADEMIK">AKADEMIK</option>
                    <option value="NON-AKADEMIK">NON-AKADEMIK</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn-save">Update Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) { document.getElementById(id).style.display = 'flex'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }

    function openEditModal(id, name, points, category) {
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_points').value = points;
        document.getElementById('edit_category').value = category;
        document.getElementById('formEdit').action = '/appreciation-categories/' + id;
        openModal('modalEdit');
    }

    window.onclick = function(event) {
        if (event.target.className === 'modal-overlay') {
            event.target.style.display = 'none';
        }
    }
</script>
@endsection