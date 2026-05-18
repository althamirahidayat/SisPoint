@extends('layouts.admin')

@section('styles')
<style>
    /* --- Styles yang sudah ada --- */
    .page-header-box { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .page-header-box h2 { font-size: 26px; font-weight: 800; color: #0F172A; }
    .page-header-box p { color: #64748B; font-size: 14px; margin-top: 4px; font-weight: 600; }

    .btn-primary-custom {
        background: #6366F1; color: white; padding: 12px 20px; font-size: 14px; font-weight: 700;
        border-radius: 12px; text-decoration: none; border: none; display: inline-flex;
        align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        cursor: pointer; transition: 0.2s;
    }
    .btn-primary-custom:hover { background: #4F46E5; }

    .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; margin-bottom: 35px; }
    .info-card { background: white; border-radius: 20px; padding: 25px; display: flex; gap: 20px; border: 1px solid #EEF2F6; position: relative; }
    .info-card::before { content: ''; position: absolute; left: 0; top: 25px; bottom: 25px; width: 4px; border-radius: 0 4px 4px 0; }
    .info-card.blue::before { background: #2563EB; }
    .info-card.red::before { background: #EF4444; }
    .info-icon-box { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .info-card.blue .info-icon-box { background: #DBEAFE; color: #2563EB; }
    .info-card.red .info-icon-box { background: #FEE2E2; color: #EF4444; }
    .info-text-box h4 { font-size: 15px; font-weight: 800; color: #1E293B; margin-bottom: 6px; }
    .info-text-box p { font-size: 13px; color: #64748B; font-weight: 600; line-height: 1.6; }

    .main-table-card { background: white; border-radius: 24px; padding: 30px; border: 1px solid #EEF2F6; box-shadow: 0 4px 20px rgba(0,0,0,0.01); }
    .violation-table { width: 100%; border-collapse: collapse; text-align: left; }
    .violation-table th { padding: 16px 20px; color: #94A3B8; font-size: 11px; font-weight: 800; letter-spacing: 0.8px; border-bottom: 1px solid #F1F5F9; }
    .violation-table td { padding: 18px 20px; font-size: 14px; font-weight: 700; color: #1E293B; border-bottom: 1px solid #F8FAFC; }

    .badge-cat { font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 6px; display: inline-block; }
    .badge-cat.ringan, .badge-cat.RINGAN { color: #2563EB; background: #DBEAFE; }
    .badge-cat.sedang, .badge-cat.SEDANG { color: #D97706; background: #FEF3C7; }
    .badge-cat.berat, .badge-cat.BERAT { color: #DC2626; background: #FEE2E2; }

    .status-online { display: inline-flex; align-items: center; gap: 8px; font-size: 12px; color: #475569; font-weight: 700; }
    .status-dot { width: 7px; height: 7px; background-color: #10B981; border-radius: 50%; }

    .action-links button, .action-links a { background: none; border: none; text-decoration: none; font-size: 12px; font-weight: 800; margin-left: 12px; cursor: pointer; padding: 0; }
    .link-edit { color: #6366F1; }
    .link-hapus { color: #EF4444; }

    /* --- Styles Baru untuk Modal (Pop-out) --- */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background: white;
        width: 100%;
        max-width: 450px;
        padding: 30px;
        border-radius: 24px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        animation: modalFadeIn 0.3s ease;
    }
    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .modal-header { margin-bottom: 20px; }
    .modal-header h3 { font-size: 18px; font-weight: 800; color: #0F172A; }
    
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; font-size: 12px; font-weight: 700; color: #64748B; margin-bottom: 8px; }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid #E2E8F0;
        font-size: 14px;
        font-weight: 600;
        outline: none;
        transition: 0.2s;
    }
    .form-control:focus { border-color: #6366F1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }
    
    .modal-footer { display: flex; justify-content: flex-end; gap: 12px; margin-top: 25px; }
    .btn-cancel { background: #F1F5F9; color: #475569; padding: 12px 20px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }
    .btn-save { background: #6366F1; color: white; padding: 12px 20px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }
</style>
@endsection

@section('content')
<div class="page-header-box">
    <div>
        <h2>Jenis Pelanggaran</h2>
        <p>Daftar referensi poin pelanggaran yang berlaku di SMKN 1 Kota Bekasi.</p>
    </div>
    <button class="btn-primary-custom" onclick="openModal('modalTambah')">
        <i class="fa-solid fa-plus"></i> Tambah Jenis
    </button>
</div>

<div class="info-grid">
    <div class="info-card blue">
        <div class="info-icon-box"><i class="fa-solid fa-circle-info"></i></div>
        <div class="info-text-box">
            <h4>Informasi Poin</h4>
            <p>Poin diakumulasi selama satu tahun ajaran. Siswa dengan poin melebihi batas tertentu akan mendapatkan pembinaan khusus.</p>
        </div>
    </div>
    <div class="info-card red">
        <div class="info-icon-box"><i class="fa-solid fa-shield-virus"></i></div>
        <div class="info-text-box">
            <h4>Batas Poin</h4>
            <p><strong>75 Poin:</strong> Panggilan Orang Tua. <br> <strong>150 Poin:</strong> SP 1. <strong>250 Poin:</strong> Dikembalikan ke Orang Tua.</p>
        </div>
    </div>
</div>

<div class="main-table-card">
    <table class="violation-table">
        <thead>
            <tr>
                <th style="width: 40%;">NAMA PELANGGARAN</th>
                <th style="width: 15%;">KATEGORI</th>
                <th style="width: 15%;">POIN</th>
                <th style="width: 15%;">STATUS</th>
                <th style="width: 15%; text-align: right;">AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $item)
            <tr>
                <td style="color: #0F172A; font-weight: 800;">{{ $item->name }}</td>
                <td><span class="badge-cat {{ strtolower($item->category) }}">{{ $item->category }}</span></td>
                <td>{{ $item->points }} Poin</td>
                <td>
                    <div class="status-online"><span class="status-dot"></span> {{ $item->is_active ? 'AKTIF' : 'NON-AKTIF' }}</div>
                </td>
                <td class="action-links" style="text-align: right;">
                    <button type="button" class="link-edit" 
                        onclick="openEditModal('{{ $item->id }}', '{{ $item->name }}', '{{ $item->points }}', '{{ $item->category }}')">
                        Edit
                    </button>
                    
                    <form action="{{ route('violation-categories.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="link-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalTambah" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Jenis Pelanggaran</h3>
        </div>
        <form action="{{ route('violation-categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>NAMA PELANGGARAN</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama pelanggaran..." required>
            </div>
            <div class="form-group">
                <label>JUMLAH POIN</label>
                <input type="number" name="points" class="form-control" placeholder="Contoh: 10" required>
            </div>
            <div class="form-group">
                <label>KATEGORI</label>
                <select name="category" class="form-control">
                    <option value="RINGAN">RINGAN</option>
                    <option value="SEDANG">SEDANG</option>
                    <option value="BERAT">BERAT</option>
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
            <h3>Edit Jenis Pelanggaran</h3>
        </div>
        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>NAMA PELANGGARAN</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>JUMLAH POIN</label>
                <input type="number" name="points" id="edit_points" class="form-control" required>
            </div>
            <div class="form-group">
                <label>KATEGORI</label>
                <select name="category" id="edit_category" class="form-control">
                    <option value="RINGAN">RINGAN</option>
                    <option value="SEDANG">SEDANG</option>
                    <option value="BERAT">BERAT</option>
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
    // Fungsi umum buka/tutup modal
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // Fungsi khusus buka modal edit dan isi datanya
    function openEditModal(id, name, points, category) {
        // Isi value form
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_points').value = points;
        document.getElementById('edit_category').value = category;

        // Set action form agar mengarah ke route update yang benar
        document.getElementById('formEdit').action = '/violation-categories/' + id;

        // Tampilkan modal
        openModal('modalEdit');
    }

    // Menutup modal jika klik di luar kotak putih
    window.onclick = function(event) {
        if (event.target.className === 'modal-overlay') {
            event.target.style.display = 'none';
        }
    }
</script>
@endsection