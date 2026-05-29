@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 35px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="font-size: 28px; font-weight: 800; color: #0F172A;">Manajemen Data Siswa</h2>
        <p style="color: #64748B; font-size: 14px; margin-top: 5px; font-weight: 600;">Kelola data murid dan akun otomatis sistem SISPOINT.</p>
    </div>
    <button onclick="document.getElementById('modalSiswa').style.display='flex'" style="background: #2563EB; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 12px rgba(37,99,235,0.2);">
        <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah Murid
    </button>
</div>

@if(session('success'))
    <div style="background: #DCFCE7; color: #16A34A; padding: 15px; border-radius: 12px; margin-bottom: 20px; font-weight: 700;">
        {{ session('success') }}
    </div>
@endif

<div style="background: white; padding: 35px; border-radius: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.01);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800;">NIS</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800;">NAMA LENGKAP</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800;">KELAS</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800;">USERNAME SISTEM</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; text-align: center;">AKSI</th>
            </tr>
        </thead>
        <tbody style="color: #1E293B; font-size: 14px; font-weight: 600;">
            @forelse($students as $siswa)
            <tr style="border-bottom: 1px solid #E2E8F0;">
                <td style="padding: 20px;">{{ $siswa->nis }}</td>
                <td style="padding: 20px;">{{ $siswa->nama_lengkap }}</td>
                <td style="padding: 20px;"><span style="background: #F1F5F9; padding: 6px 12px; border-radius: 8px;">{{ $siswa->kelas }}</span></td>
                <td style="padding: 20px; color: #2563EB;"><strong>{{ $siswa->user->username ?? '-' }}</strong></td>
                <td style="padding: 20px; text-align: center;">
                    <form action="{{ route('students.destroy', $siswa->nis) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data murid ini? Akun login juga akan terhapus.')" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #DC2626; cursor: pointer; font-size: 16px;">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 30px; text-align: center; color: #94A3B8;">Belum ada data siswa terpajang. Silakan input baru.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="modalSiswa" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
        <div style="background: #0B192C; padding: 20px 30px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 18px; font-weight: 800;">Tambah Data Murid Baru</h3>
            <button onclick="document.getElementById('modalSiswa').style.display='none'" style="background: none; border: none; color: white; font-size: 20px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('students.store') }}" method="POST" style="padding: 30px;">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; font-weight: 800; color: #334155; margin-bottom: 8px;">NOMOR INDUK SISWA (NIS)</label>
                <input type="text" name="nis" required style="width: 100%; padding: 12px; border: 1.5px solid #BFDBFE; border-radius: 10px; font-weight: 600;" placeholder="Contoh: 222310199">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; font-weight: 800; color: #334155; margin-bottom: 8px;">NAMA LENGKAP MURID</label>
                <input type="text" name="nama_lengkap" required style="width: 100%; padding: 12px; border: 1.5px solid #BFDBFE; border-radius: 10px; font-weight: 600;" placeholder="Contoh: Althamiera Hidayat">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; font-weight: 800; color: #334155; margin-bottom: 8px;">KELAS</label>
                <input type="text" name="kelas" required style="width: 100%; padding: 12px; border: 1.5px solid #BFDBFE; border-radius: 10px; font-weight: 600;" placeholder="Contoh: XI PPLG B">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; font-weight: 800; color: #334155; margin-bottom: 8px;">NOMOR TELEPON HP</label>
                <input type="text" name="no_telp" style="width: 100%; padding: 12px; border: 1.5px solid #BFDBFE; border-radius: 10px; font-weight: 600;" placeholder="Contoh: 0812xxxxxxxx">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 12px; font-weight: 800; color: #334155; margin-bottom: 8px;">ALAMAT RUMAH TINGGAL</label>
                <textarea name="alamat" rows="3" style="width: 100%; padding: 12px; border: 1.5px solid #BFDBFE; border-radius: 10px; font-weight: 600; resize: none;" placeholder="Tulis alamat rumah lengkap murid..."></textarea>
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="document.getElementById('modalSiswa').style.display='none'" style="background: #F1F5F9; color: #475569; border: none; padding: 12px 20px; font-weight: 700; border-radius: 10px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #2563EB; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 10px; cursor: pointer;">Simpan & Buat Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection