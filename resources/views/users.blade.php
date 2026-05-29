@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 35px;">
    <h2 style="font-size: 28px; font-weight: 800; color: #0F172A;">Manajemen Pengguna</h2>
    <p style="color: #64748B; font-size: 14px; margin-top: 5px; font-weight: 600;">Kelola hak akses dan akun pengguna sistem SISPOINT.</p>
</div>

@if(session('success'))
    <div style="background: #DCFCE7; color: #16A34A; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 700;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
    </div>
@endif

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

    <div onclick="openModalWalas()" style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 12px rgba(234,179,8,0.05); border: 1.5px solid #FEF08A; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
        <div style="width: 50px; height: 50px; background-color: #FEF9C3; color: #EAB308; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-chalkboard-user"></i>
        </div>
        <div style="flex-grow: 1;">
            <h4 style="font-size: 15px; font-weight: 800; color: #EAB308;">Wali Kelas</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Klik untuk tambah wali kelas</p>
        </div>
        <i class="fa-solid fa-circle-plus" style="color: #EAB308; font-size: 18px;"></i>
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

    <div onclick="openModalSiswa()" style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 12px rgba(37,99,235,0.05); border: 1.5px solid #BFDBFE; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
        <div style="width: 50px; height: 50px; background-color: #FFEDD5; color: #EA580C; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div style="flex-grow: 1;">
            <h4 style="font-size: 15px; font-weight: 800; color: #EA580C;">Siswa</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Klik untuk tambah akun siswa</p>
        </div>
        <i class="fa-solid fa-circle-plus" style="color: #EA580C; font-size: 18px;"></i>
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
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; letter-spacing: 0.5px;">ROLE / KELAS</th>
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

            @foreach($students as $siswa)
            <tr style="border-bottom: 1px solid #E2E8F0;">
                <td style="padding: 20px;">{{ $siswa->nama_lengkap }}</td>
                <td style="padding: 20px; color: #2563EB;">{{ $siswa->user->username ?? '-' }}</td>
                <td style="padding: 20px;"><span style="font-size: 12px; font-weight: 800; color: #EA580C;">SISWA ({{ $siswa->kelas }})</span></td>
                <td style="padding: 20px; text-align: center; font-size: 16px;">
                    <form action="{{ route('users.siswa.destroy', $siswa->nis) }}" method="POST" onsubmit="return confirm('Hapus siswa ini beserta akun loginfisiknya?')" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:#64748B; cursor:pointer; font-size:16px;">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalSiswaOtomatis" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #E2E8F0;">
        <div style="background: #0B192C; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 18px; font-weight: 800; letter-spacing: 0.5px;">Tambah Akun Siswa</h3>
                <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;">Sistem akan membuatkan Username & Password secara otomatis.</p>
            </div>
            <button type="button" onclick="closeModalSiswa()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('users.siswa.store') }}" method="POST" style="padding: 30px;">
            @csrf
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nomor Induk Siswa (NIS)</label>
                <input type="text" name="nis" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #BFDBFE; border-radius: 12px; font-weight: 600;" placeholder="Masukkan NIS murid">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #BFDBFE; border-radius: 12px; font-weight: 600;" placeholder="Masukkan nama lengkap">
            </div>
            
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Kelas</label>
                <select name="kelas" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #BFDBFE; border-radius: 12px; font-weight: 600; background: white; cursor: pointer;">
                    <option value="" disabled selected>-- Pilih Kelas Murid --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">No. Telepon</label>
                <input type="text" name="no_telp" style="width: 100%; padding: 12px 16px; border: 1.5px solid #BFDBFE; border-radius: 12px; font-weight: 600;" placeholder="Contoh: 0812XXXXXXXX">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Alamat Rumah</label>
                <textarea name="alamat" rows="3" style="width: 100%; padding: 12px 16px; border: 1.5px solid #BFDBFE; border-radius: 12px; font-weight: 600; resize: none;" placeholder="Alamat lengkap tinggal..."></textarea>
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="closeModalSiswa()" style="background: #F1F5F9; color: #475569; border: none; padding: 12px 20px; font-weight: 700; border-radius: 12px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #2563EB; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 14px rgba(37,99,235,0.2);">Simpan & Buat Akun</button>
            </div>
        </form>
    </div>
</div>

<div id="modalWalasOtomatis" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #E2E8F0;">
        <div style="background: #0B192C; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 18px; font-weight: 800; letter-spacing: 0.5px;">Tambah Akun Wali Kelas</h3>
                <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;">Sistem akan membuatkan akun Wali Kelas baru.</p>
            </div>
            <button type="button" onclick="closeModalWalas()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('users.walas.store') }}" method="POST" style="padding: 30px;">
            @csrf
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">NIP Wali Kelas</label>
                <input type="text" name="nip" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600;" placeholder="Masukkan NIP Wali Kelas">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nama Lengkap</label>
                <input type="text" name="nama" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600;" placeholder="Contoh: Pak Hilal, S.Pd">
            </div>
            
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Kelas Binaan (Mengampu)</label>
                <select name="kelas_binaan" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600; background: white; cursor: pointer;">
                    <option value="" disabled selected>-- Pilih Kelas Binaan --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">No. Telepon</label>
                <input type="text" name="no_telp" style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600;" placeholder="Contoh: 0812XXXXXXXX">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Alamat Rumah</label>
                <textarea name="alamat" rows="3" style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600; resize: none;" placeholder="Alamat lengkap..."></textarea>
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="closeModalWalas()" style="background: #F1F5F9; color: #475569; border: none; padding: 12px 20px; font-weight: 700; border-radius: 12px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #EAB308; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 14px rgba(234,179,8,0.2);">Simpan & Buat Akun</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi Kontrol Modal Siswa
    function openModalSiswa() {
        document.getElementById('modalSiswaOtomatis').style.display = 'flex';
    }
    function closeModalSiswa() {
        document.getElementById('modalSiswaOtomatis').style.display = 'none';
    }

    // Fungsi Kontrol Modal Wali Kelas
    function openModalWalas() {
        document.getElementById('modalWalasOtomatis').style.display = 'flex';
    }
    function closeModalWalas() {
        document.getElementById('modalWalasOtomatis').style.display = 'none';
    }
</script>
@endsection