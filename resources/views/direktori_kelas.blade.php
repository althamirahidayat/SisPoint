@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; font-family: 'Inter', sans-serif;">
    <div>
        <h2 style="font-size: 28px; font-weight: 800; color: #0F172A; margin: 0;">Direktori Kelas</h2>
        <p style="color: #64748B; font-size: 14px; margin-top: 5px; font-weight: 600; margin-bottom: 0;">Pantau status posisi, wali kelas, dan total murid SMKN 1 Kota Bekasi.</p>
    </div>
    <button onclick="openModalKelas()" style="background: #2563EB; color: white; border: none; padding: 12px 22px; font-weight: 700; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 12px rgba(37,99,235,0.15); display: flex; align-items: center; gap: 8px; font-size: 14px;">
        <i class="fa-solid fa-folder-plus"></i> Tambah Kelas Baru
    </button>
</div>

@if(session('success'))
    <div style="background: #DCFCE7; color: #16A34A; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 700; font-family: 'Inter', sans-serif;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
    </div>
@endif

<div style="background: white; padding: 35px; border-radius: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.01); font-family: 'Inter', sans-serif;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">NAMA KELAS</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">WALI KELAS</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">ANGKATAN</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">TOTAL SISWA</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">STATUS POSISI</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px; text-align: center;">AKSI</th>
            </tr>
        </thead>
        <tbody style="color: #1E293B; font-size: 14px; font-weight: 600;">
            @forelse($daftar_kelas as $kelas)
            <tr style="border-bottom: 1px solid #E2E8F0;">
                <td style="padding: 20px;">
                    <a href="{{ route('kelas.show', $kelas->id_kelas) }}" style="color: #2563EB; font-weight: 800; text-decoration: none; border-bottom: 1px dotted #2563EB; padding-bottom: 2px;" title="Klik untuk melihat biodata kelas & daftar siswa">
                        {{ $kelas->nama_kelas }}
                    </a>
                </td>
                <td style="padding: 20px;">{{ $kelas->wali_kelas }}</td>
                <td style="padding: 20px; color: #64748B;">{{ $kelas->angkatan }}</td>
                <td style="padding: 20px;">{{ $kelas->jumlah_siswa }} Murid</td>
                <td style="padding: 20px;">
                    <form action="{{ route('kelas.updateStatus', $kelas->id_kelas) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        @if($kelas->status_kelas == 'Di Sekolah')
                            <input type="hidden" name="status_kelas" value="PKL">
                            <button type="submit" style="background: #DCFCE7; color: #16A34A; border: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 800; cursor: pointer;" title="Klik untuk ubah ke status PKL"><i class="fa-solid fa-school"></i> Di Sekolah</button>
                        @else
                            <input type="hidden" name="status_kelas" value="Di Sekolah">
                            <button type="submit" style="background: #FEF9C3; color: #A16207; border: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 800; cursor: pointer;" title="Klik untuk ubah ke status Di Sekolah"><i class="fa-solid fa-building-user"></i> Sedang PKL</button>
                        @endif
                    </form>
                </td>
                <td style="padding: 20px; text-align: center; font-size: 16px;">
                    <button onclick="openModalEdit('{{ $kelas->id_kelas }}', '{{ $kelas->nama_kelas }}', '{{ $kelas->wali_kelas }}', '{{ $kelas->angkatan }}', '{{ $kelas->jumlah_siswa }}')" style="background: none; border: none; color: #64748B; margin-right: 12px; cursor: pointer; font-size: 16px;">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus kelas {{ $kelas->nama_kelas }} secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #EF4444; cursor: pointer; font-size: 16px;">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 40px; text-align: center; color: #94A3B8;">Belum ada data kelas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="modalTambahKelas" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999; font-family: 'Inter', sans-serif;">
    <div style="background: white; width: 100%; max-width: 480px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
        <div style="background: #0B192C; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 18px; font-weight: 800;">Daftarkan Kelas Baru</h3>
            <button type="button" onclick="closeModalKelas()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('kelas.store') }}" method="POST" style="padding: 30px;">
            @csrf
            <div style="margin-bottom: 18px;">
                <label style="display:block; font-size:11px; font-weight:800; margin-bottom:8px; color: #475569;">NAMA KELAS</label>
                <input type="text" name="nama_kelas" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px; font-weight: 600;" placeholder="Contoh: XII PPLG A">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display:block; font-size:11px; font-weight:800; margin-bottom:8px; color: #475569;">WALI KELAS</label>
                <input type="text" name="wali_kelas" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px; font-weight: 600;" placeholder="Nama Guru">
            </div>
            <div style="grid-template-columns: 1fr 1fr; display: grid; gap: 15px; margin-bottom: 25px;">
                <div>
                    <label style="display:block; font-size:11px; font-weight:800; margin-bottom:8px; color: #475569;">ANGKATAN</label>
                    <input type="text" name="angkatan" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px; font-weight: 600;" placeholder="2024/2025">
                </div>
                <div>
                    <label style="display:block; font-size:11px; font-weight:800; margin-bottom:8px; color: #475569;">JUMLAH SISWA</label>
                    <input type="number" name="jumlah_siswa" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px; font-weight: 600;" placeholder="0">
                </div>
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="closeModalKelas()" style="background: #F1F5F9; border:none; padding:12px 20px; font-weight:700; border-radius:12px; cursor:pointer; color: #475569;">Batal</button>
                <button type="submit" style="background: #2563EB; color:white; border:none; padding:12px 24px; font-weight:700; border-radius:12px; cursor:pointer;">Simpan Kelas</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditKelas" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999; font-family: 'Inter', sans-serif;">
    <div style="background: white; width: 100%; max-width: 480px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
        <div style="background: #2563EB; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 18px; font-weight: 800;">Ubah Data Kelas</h3>
            <button type="button" onclick="closeModalEdit()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form id="formEditKelas" method="POST" style="padding: 30px;">
            @csrf
            @method('PUT')
            <div style="margin-bottom: 18px;">
                <label style="display:block; font-size:11px; font-weight:800; margin-bottom:8px; color: #475569;">NAMA KELAS</label>
                <input type="text" id="edit_nama_kelas" name="nama_kelas" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px; font-weight: 600;">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display:block; font-size:11px; font-weight:800; margin-bottom:8px; color: #475569;">WALI KELAS</label>
                <input type="text" id="edit_wali_kelas" name="wali_kelas" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px; font-weight: 600;">
            </div>
            <div style="grid-template-columns: 1fr 1fr; display: grid; gap: 15px; margin-bottom: 25px;">
                <div>
                    <label style="display:block; font-size:11px; font-weight:800; margin-bottom:8px; color: #475569;">ANGKATAN</label>
                    <input type="text" id="edit_angkatan" name="angkatan" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px; font-weight: 600;">
                </div>
                <div>
                    <label style="display:block; font-size:11px; font-weight:800; margin-bottom:8px; color: #475569;">JUMLAH SISWA</label>
                    <input type="number" id="edit_jumlah_siswa" name="jumlah_siswa" required style="width:100%; padding:12px; border:1.5px solid #CBD5E1; border-radius:12px; font-weight: 600;">
                </div>
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="closeModalEdit()" style="background: #F1F5F9; border:none; padding:12px 20px; font-weight:700; border-radius:12px; cursor:pointer; color: #475569;">Batal</button>
                <button type="submit" style="background: #2563EB; color:white; border:none; padding:12px 24px; font-weight:700; border-radius:12px; cursor:pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModalKelas() { document.getElementById('modalTambahKelas').style.display = 'flex'; }
    function closeModalKelas() { document.getElementById('modalTambahKelas').style.display = 'none'; }
    
    function openModalEdit(id, nama, wali, angkatan, jumlah) {
        document.getElementById('formEditKelas').action = '/direktori-kelas/' + id;
        document.getElementById('edit_nama_kelas').value = nama;
        document.getElementById('edit_wali_kelas').value = wali;
        document.getElementById('edit_angkatan').value = angkatan;
        document.getElementById('edit_jumlah_siswa').value = jumlah;
        document.getElementById('modalEditKelas').style.display = 'flex';
    }
    function closeModalEdit() { document.getElementById('modalEditKelas').style.display = 'none'; }
</script>
@endsection