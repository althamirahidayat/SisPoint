@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 35px;">
    <h2 style="font-size: 28px; font-weight: 800; color: #0F172A;">Manajemen Pengguna</h2>
    <p style="color: #64748B; font-size: 14px; margin-top: 5px; font-weight: 600;">Kelola hak akses dan akun pengguna sistem SISPOINT.</p>
</div>

{{-- Banner Notifikasi Sukses --}}
@if(session('success'))
    <div style="background: #DCFCE7; color: #16A34A; padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 700;">
        <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}
    </div>
@endif

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 40px;">
    {{-- KARTU GURU BK --}}
    <div onclick="openModalBk()" style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 12px rgba(37,99,235,0.05); border: 1.5px solid #BFDBFE; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
        <div style="width: 50px; height: 50px; background-color: #DBEAFE; color: #2563EB; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-user-shield"></i>
        </div>
        <div style="flex-grow: 1;">
            <h4 style="font-size: 15px; font-weight: 800; color: #2563EB;">Guru BK</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Klik untuk tambah guru BK</p>
        </div>
        <i class="fa-solid fa-circle-plus" style="color: #2563EB; font-size: 18px;"></i>
    </div>

    {{-- KARTU WALI KELAS --}}
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

    {{-- KARTU OSIS --}}
    <div onclick="openModalOsis()" style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 12px rgba(220,38,38,0.05); border: 1.5px solid #FEE2E2; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
        <div style="width: 50px; height: 50px; background-color: #FEE2E2; color: #DC2626; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-users"></i>
        </div>
        <div style="flex-grow: 1;">
            <h4 style="font-size: 15px; font-weight: 800; color: #DC2626;">Pengurus OSIS</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Klik untuk tambah akun OSIS</p>
        </div>
        <i class="fa-solid fa-circle-plus" style="color: #DC2626; font-size: 18px;"></i>
    </div>

    {{-- KARTU SISWA --}}
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

    {{-- KARTU ORANG TUA --}}
    <div onclick="openModalOrtu()" style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 12px rgba(22,163,74,0.05); border: 1.5px solid #DCFCE7; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
        <div style="width: 50px; height: 50px; background-color: #DCFCE7; color: #16A34A; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-user-group"></i>
        </div>
        <div style="flex-grow: 1;">
            <h4 style="font-size: 15px; font-weight: 800; color: #16A34A;">Orang Tua</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Klik untuk tambah akun ortu</p>
        </div>
        <i class="fa-solid fa-circle-plus" style="color: #16A34A; font-size: 18px;"></i>
    </div>

    {{-- KARTU ADMIN --}}
    <div onclick="openModalAdmin()" style="background: white; padding: 25px; border-radius: 20px; display: flex; align-items: center; gap: 20px; box-shadow: 0 4px 12px rgba(71,85,105,0.05); border: 1.5px solid #E2E8F0; cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
        <div style="width: 50px; height: 50px; background-color: #F1F5F9; color: #475569; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fa-solid fa-user-gear"></i>
        </div>
        <div style="flex-grow: 1;">
            <h4 style="font-size: 15px; font-weight: 800; color: #475569;">Admin</h4>
            <p style="color: #64748B; font-size: 12px; margin-top: 2px;">Klik untuk tambah pengelola</p>
        </div>
        <i class="fa-solid fa-circle-plus" style="color: #475569; font-size: 18px;"></i>
    </div>
</div>

<div style="background: white; padding: 35px; border-radius: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.01);">
    <div style="margin-bottom: 25px;">
        <h3 style="font-size: 18px; font-weight: 800; color: #0F172A; margin: 0;">Daftar Pengguna Aktif</h3>
        <p style="color: #64748B; font-size: 13px; margin-top: 4px; font-weight: 600;">Saring atau cari data akun pengguna secara instan.</p>
    </div>
    
    <form action="{{ route('users.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px; align-items: flex-end;">
        <div style="flex: 2; min-width: 280px;">
            <div style="display: flex; align-items: center; background-color: #FFFFFF; border: 1.5px solid #E2E8F0; border-radius: 12px; padding: 2px 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.01);">
                <i class="fa-solid fa-magnifying-glass" style="color: #94A3B8; font-size: 14px; margin-right: 12px;"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, role, atau kelas..." 
                       style="width: 100%; background: transparent; border: none; padding: 10px 0; color: #1E293B; font-size: 14px; font-weight: 600; outline: none; box-shadow: none;">
            </div>
        </div>

        <div style="flex: 1; min-width: 160px;">
            <label style="display: block; font-size: 11px; font-weight: 800; color: #64748B; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Filter Role:</label>
            <select name="role" style="width: 100%; padding: 11px 16px; border: 1.5px solid #E2E8F0; border-radius: 12px; font-weight: 700; color: #334155; background-color: white; cursor: pointer; font-size: 13px; outline: none;">
                <option value="">Semua Role</option>
                <option value="siswa" {{ request('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                <option value="walas" {{ request('role') == 'walas' ? 'selected' : '' }}>Wali Kelas</option>
                <option value="bk" {{ request('role') == 'bk' ? 'selected' : '' }}>Guru BK</option>
                <option value="osis" {{ request('role') == 'osis' ? 'selected' : '' }}>Pengurus OSIS</option>
                <option value="ortu" {{ request('role') == 'ortu' ? 'selected' : '' }}>Orang Tua</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div style="flex: 1; min-width: 160px;">
            <label style="display: block; font-size: 11px; font-weight: 800; color: #64748B; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">Filter Kelas:</label>
            <select name="kelas" style="width: 100%; padding: 11px 16px; border: 1.5px solid #E2E8F0; border-radius: 12px; font-weight: 700; color: #334155; background-color: white; cursor: pointer; font-size: 13px; outline: none;">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->nama_kelas }}" {{ request('kelas') == $k->nama_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; gap: 10px; min-width: 150px;">
            <button type="submit" style="background: #0B192C; color: white; border: none; padding: 11px 18px; font-weight: 700; border-radius: 12px; cursor: pointer; font-size: 13px; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: opacity 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                <i class="fa-solid fa-filter"></i> Cari
            </button>
            
            @if(request('search') || request('role') || request('kelas'))
                <a href="{{ route('users.index') }}" style="background: #F1F5F9; color: #475569; border: 1.5px solid #E2E8F0; padding: 10px 14px; font-weight: 700; border-radius: 12px; cursor: pointer; font-size: 13px; display: flex; align-items: center; justify-content: center; text-decoration: none;" title="Reset Pencarian">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            @endif
        </div>
    </form>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; text-transform: uppercase;">Nama Pengguna</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; text-transform: uppercase;">Username</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; text-transform: uppercase;">Hak Akses / Detail</th>
                <th style="padding: 15px 20px; color: #64748B; font-size: 12px; font-weight: 800; text-transform: uppercase; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody style="color: #1E293B; font-size: 14px; font-weight: 600;">
            @forelse($allUsers as $user)
                <tr style="border-bottom: 1px solid #E2E8F0;">
                    <td style="padding: 20px;">{{ $user->name }}</td>
                    <td style="padding: 20px; color: #64748B;">{{ $user->username }}</td>
                    <td style="padding: 20px;">
                        @if($user->role === 'siswa')
                            <span style="font-size: 11px; padding: 4px 10px; background: #FFEDD5; color: #EA580C; border-radius: 6px; font-weight: 800; text-transform: uppercase;">
                                Siswa ({{ $user->siswa->kelas ?? '-' }})
                            </span>
                        @elseif($user->role === 'walas')
                            <span style="font-size: 11px; padding: 4px 10px; background: #FEF9C3; color: #EAB308; border-radius: 6px; font-weight: 800; text-transform: uppercase;">
                                Wali Kelas
                            </span>
                        @elseif($user->role === 'bk')
                            <span style="font-size: 11px; padding: 4px 10px; background: #DBEAFE; color: #2563EB; border-radius: 6px; font-weight: 800; text-transform: uppercase;">
                                Guru BK
                            </span>
                        @elseif($user->role === 'osis')
                            <span style="font-size: 11px; padding: 4px 10px; background: #FEE2E2; color: #DC2626; border-radius: 6px; font-weight: 800; text-transform: uppercase;">
                                Pengurus OSIS
                            </span>
                        @elseif($user->role === 'ortu')
                            <span style="font-size: 11px; padding: 4px 10px; background: #DCFCE7; color: #16A34A; border-radius: 6px; font-weight: 800; text-transform: uppercase;">
                                Orang Tua
                            </span>
                        @else
                            <span style="font-size: 11px; padding: 4px 10px; background: #F1F5F9; color: #475569; border-radius: 6px; font-weight: 800; text-transform: uppercase;">
                                {{ $user->role }}
                            </span>
                        @endif
                    </td>
                    <td style="padding: 20px; text-align: center; font-size: 16px;">
                        <a href="#" style="color: #64748B; margin-right: 15px; text-decoration: none;"><i class="fa-regular fa-pen-to-square"></i></a>
                        
                        @if($user->role === 'siswa' && $user->siswa)
                            <form action="{{ route('users.siswa.destroy', $user->siswa->nis) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus akun siswa ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#64748B; cursor:pointer; font-size:16px; padding:0;">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        @else
                            <a href="#" style="color: #64748B; text-decoration: none;"><i class="fa-regular fa-trash-can"></i></a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 700;">
                        <i class="fa-solid fa-folder-open" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                        Data akun tidak ditemukan atau filter tidak sesuai.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    input::placeholder {
        color: #94A3B8 !important;
        opacity: 1;
    }
</style>

{{-- ========================================================================== --}}
{{-- PUSAT POP-UP MODAL (SUDAH DISATUKAN & BERSIH) --}}
{{-- ========================================================================== --}}

{{-- MODAL INPUT DATA SISWA --}}
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

{{-- MODAL INPUT DATA WALI KELAS --}}
<div id="modalWalasOtomatis" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: {{ $errors->has('nip') || $errors->has('nama') || $errors->has('kelas_binaan') ? 'flex' : 'none' }}; justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #E2E8F0;">
        <div style="background: #0B192C; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 18px; font-weight: 800; letter-spacing: 0.5px;">Tambah Akun Wali Kelas</h3>
                <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;">Sistem akan membuatkan akun Wali Kelas baru secara otomatis.</p>
            </div>
            <button type="button" onclick="closeModalWalas()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        
        <form action="{{ route('users.walas.store') }}" method="POST" style="padding: 30px;">
            @csrf
            
            @if ($errors->any())
                <div style="background: #FEE2E2; color: #DC2626; padding: 12px; border-radius: 12px; margin-bottom: 18px; font-size: 13px; font-weight: 700;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">NIP Wali Kelas</label>
                <input type="text" name="nip" value="{{ old('nip') }}" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600;" placeholder="Masukkan NIP Wali Kelas">
            </div>
            
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600;" placeholder="Contoh: Pak Hilal, S.Pd">
            </div>
            
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Kelas Binaan (Mengampu)</label>
                <select name="kelas_binaan" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600; background: white; cursor: pointer;">
                    <option value="" disabled selected>-- Pilih Kelas Binaan --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->nama_kelas }}" {{ old('kelas_binaan') == $k->nama_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">No. Telepon</label>
                <input type="text" name="no_telp" value="{{ old('no_telp') }}" style="width: 100%; padding: 12px 16px; border: 1.5px solid #EAB308; border-radius: 12px; font-weight: 600;" placeholder="Contoh: 0812XXXXXXXX">
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

{{-- MODAL INPUT DATA GURU BK --}}
<div id="modalBkOtomatis" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #E2E8F0;">
        <div style="background: #0B192C; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 18px; font-weight: 800; letter-spacing: 0.5px;">Tambah Akun Guru BK</h3>
                <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;">Sistem akan otomatis membuatkan akun login Guru BK.</p>
            </div>
            <button type="button" onclick="closeModalBk()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('users.bk.store') }}" method="POST" style="padding: 30px;">
            @csrf
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">NIP Guru BK</label>
                <input type="text" name="nip_bk" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #2563EB; border-radius: 12px; font-weight: 600;" placeholder="Masukkan NIP Guru BK">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nama Lengkap</label>
                <input type="text" name="nama_bk" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #2563EB; border-radius: 12px; font-weight: 600;" placeholder="Contoh: Ibu Ana, S.Pd">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">No. Telepon</label>
                <input type="text" name="no_telp" style="width: 100%; padding: 12px 16px; border: 1.5px solid #2563EB; border-radius: 12px; font-weight: 600;" placeholder="Contoh: 0812XXXXXXXX">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Alamat Rumah</label>
                <textarea name="alamat" rows="3" style="width: 100%; padding: 12px 16px; border: 1.5px solid #2563EB; border-radius: 12px; font-weight: 600; resize: none;" placeholder="Alamat lengkap tinggal..."></textarea>
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="closeModalBk()" style="background: #F1F5F9; color: #475569; border: none; padding: 12px 20px; font-weight: 700; border-radius: 12px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #2563EB; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 14px rgba(37,99,235,0.2);">Simpan & Buat Akun</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL INPUT DATA OSIS --}}
<div id="modalOsisOtomatis" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #E2E8F0;">
        <div style="background: #0B192C; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 18px; font-weight: 800; letter-spacing: 0.5px;">Tambah Akun Pengurus OSIS</h3>
                <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;">Sistem akan otomatis membuatkan akses input lapangan OSIS.</p>
            </div>
            <button type="button" onclick="closeModalOsis()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('users.osis.store') }}" method="POST" style="padding: 30px;">
            @csrf
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nama Lengkap Anggota OSIS</label>
                <input type="text" name="nama_osis" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #FEE2E2; border-radius: 12px; font-weight: 600;" placeholder="Masukkan nama lengkap">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Kelas Jabatan</label>
                <select name="kelas_osis" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #FEE2E2; border-radius: 12px; font-weight: 600; background: white; cursor: pointer;">
                    <option value="" disabled selected>-- Pilih Kelas Asal --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">No. Telepon Pengurus</label>
                <input type="text" name="no_telp" style="width: 100%; padding: 12px 16px; border: 1.5px solid #FEE2E2; border-radius: 12px; font-weight: 600;" placeholder="Contoh: 0857XXXXXXXX">
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="closeModalOsis()" style="background: #F1F5F9; color: #475569; border: none; padding: 12px 20px; font-weight: 700; border-radius: 12px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #DC2626; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">Simpan & Buat Akun</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL INPUT DATA ORANG TUA --}}
<div id="modalOrtuOtomatis" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #E2E8F0;">
        <div style="background: #0B192C; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 18px; font-weight: 800; letter-spacing: 0.5px;">Tambah Akun Orang Tua</h3>
                <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;">Hubungkan pemantauan skor poin pelanggaran langsung ke Wali Murid.</p>
            </div>
            <button type="button" onclick="closeModalOrtu()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('users.ortu.store') }}" method="POST" style="padding: 30px;">
            @csrf
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">NIK Wali / Orang Tua</label>
                <input type="text" name="nik_ortu" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #DCFCE7; border-radius: 12px; font-weight: 600;" placeholder="Masukkan NIK KTP">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nama Wali / Orang Tua</label>
                <input type="text" name="nama_ortu" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #DCFCE7; border-radius: 12px; font-weight: 600;" placeholder="Nama Ayah / Ibu Kandung">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nama Anak Murid</label>
                <input type="text" name="nama_anak" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #DCFCE7; border-radius: 12px; font-weight: 600;" placeholder="Nama siswa di sekolah">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Kelas Anak</label>
                <select name="kelas_anak" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #DCFCE7; border-radius: 12px; font-weight: 600; background: white; cursor: pointer;">
                    <option value="" disabled selected>-- Pilih Kelas Anak --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">No. Telepon Rumah</label>
                <input type="text" name="no_telp" style="width: 100%; padding: 12px 16px; border: 1.5px solid #DCFCE7; border-radius: 12px; font-weight: 600;" placeholder="Nomor WA aktif orang tua">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Alamat Rumah</label>
                <textarea name="alamat" rows="3" style="width: 100%; padding: 12px 16px; border: 1.5px solid #DCFCE7; border-radius: 12px; font-weight: 600; resize: none;" placeholder="Alamat tinggal keluarga..."></textarea>
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="closeModalOrtu()" style="background: #F1F5F9; color: #475569; border: none; padding: 12px 20px; font-weight: 700; border-radius: 12px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #16A34A; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 14px rgba(22,163,74,0.2);">Simpan & Hubungkan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL INPUT DATA ADMIN --}}
<div id="modalAdminOtomatis" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); display: none; justify-content: center; align-items: center; z-index: 9999;">
    <div style="background: white; width: 100%; max-width: 500px; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); border: 1px solid #E2E8F0;">
        <div style="background: #0B192C; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-size: 18px; font-weight: 800; letter-spacing: 0.5px;">Tambah Pengelola / Admin</h3>
                <p style="font-size: 11px; color: #94A3B8; margin-top: 2px;">Hak akses tertinggi pusat monitoring data sistem.</p>
            </div>
            <button type="button" onclick="closeModalAdmin()" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form action="{{ route('users.admin.store') }}" method="POST" style="padding: 30px;">
            @csrf
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Nama Lengkap Admin</label>
                <input type="text" name="nama_admin" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 12px; font-weight: 600;" placeholder="Nama lengkap pengelola baru">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Jabatan Staf / Divisi</label>
                <input type="text" name="jabatan_admin" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 12px; font-weight: 600;" placeholder="Contoh: Staf IT / Guru Piket">
            </div>
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">No. Telepon Kantor</label>
                <input type="text" name="no_telp" style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 12px; font-weight: 600;" placeholder="Contoh: 0812XXXXXXXX">
            </div>
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 11px; font-weight: 800; color: #334155; text-transform: uppercase; margin-bottom: 8px;">Alamat Rumah</label>
                <textarea name="alamat" rows="3" style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 12px; font-weight: 600; resize: none;" placeholder="Alamat rumah tinggal pengelola..."></textarea>
            </div>
            <div style="display: flex; gap: 15px; justify-content: flex-end;">
                <button type="button" onclick="closeModalAdmin()" style="background: #F1F5F9; color: #475569; border: none; padding: 12px 20px; font-weight: 700; border-radius: 12px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #475569; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 14px rgba(71,85,105,0.2);">Simpan & Beri Akses</button>
            </div>
        </form>
    </div>
</div>

{{-- JAVASCRIPT OPEN/CLOSE MODAL MANAGEMENT --}}
<script>
    function openModalSiswa() { document.getElementById('modalSiswaOtomatis').style.display = 'flex'; }
    function closeModalSiswa() { document.getElementById('modalSiswaOtomatis').style.display = 'none'; }
    
    function openModalWalas() { document.getElementById('modalWalasOtomatis').style.display = 'flex'; }
    function closeModalWalas() { document.getElementById('modalWalasOtomatis').style.display = 'none'; }
    
    function openModalBk() { document.getElementById('modalBkOtomatis').style.display = 'flex'; }
    function closeModalBk() { document.getElementById('modalBkOtomatis').style.display = 'none'; }
    
    function openModalOsis() { document.getElementById('modalOsisOtomatis').style.display = 'flex'; }
    function closeModalOsis() { document.getElementById('modalOsisOtomatis').style.display = 'none'; }
    
    function openModalOrtu() { document.getElementById('modalOrtuOtomatis').style.display = 'flex'; }
    function closeModalOrtu() { document.getElementById('modalOrtuOtomatis').style.display = 'none'; }
    
    function openModalAdmin() { document.getElementById('modalAdminOtomatis').style.display = 'flex'; }
    function closeModalAdmin() { document.getElementById('modalAdminOtomatis').style.display = 'none'; }
</script>
@endsection