<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISPOINT - Detail Kelas {{ $kelas->nama_kelas }}</title>
</head>
<body style="font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; background-color: #F8FAFC;">

    <div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
        
        <a href="/direktori-kelas" style="text-decoration: none; color: #64748B; font-weight: 700; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 25px;">
            ← Kembali ke Direktori
        </a>

        <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 4px 18px rgba(0,0,0,0.03); margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <span style="background: #EEF2FF; color: #4F46E5; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Biodata Kelas</span>
                <h1 style="font-size: 32px; color: #1E293B; margin: 10px 0 5px 0; font-weight: 800;">{{ $kelas->nama_kelas }}</h1>
                <p style="margin: 0; color: #64748B; font-weight: 600; font-size: 15px;">👥 Wali Kelas: <strong style="color: #334155;">{{ $kelas->wali_kelas }}</strong></p>
            </div>
            <div style="display: flex; gap: 15px;">
                <div style="background: #F1F5F9; padding: 15px 20px; border-radius: 14px; text-align: center;">
                    <span style="font-size: 10px; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Angkatan</span>
                    <div style="font-size: 18px; font-weight: 700; color: #334155; margin-top: 2px;">{{ $kelas->angkatan }}</div>
                </div>
                <div style="background: #F1F5F9; padding: 15px 20px; border-radius: 14px; text-align: center;">
                    <span style="font-size: 10px; font-weight: 800; color: #94A3B8; text-transform: uppercase;">Kapasitas Berkas</span>
                    <div style="font-size: 18px; font-weight: 700; color: #334155; margin-top: 2px;">{{ $kelas->jumlah_siswa }} Murid</div>
                </div>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; box-shadow: 0 4px 18px rgba(0,0,0,0.03); overflow: hidden;">
            <div style="padding: 25px 30px; border-bottom: 1px solid #F1F5F9;">
                <h3 style="margin: 0; font-size: 18px; color: #1E293B; font-weight: 700; display: inline-flex; align-items: center; gap: 10px;">
                    👥 Anggota Kelas Terdaftar ({{ $siswa->count() }} Siswa)
                </h3>
            </div>

            <div style="padding: 20px 30px;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #F8FAFC; border-bottom: 2px solid #E2E8F0;">
                            <th style="padding: 14px; font-weight: 700; color: #475569; width: 5%;">NO</th>
                            <th style="padding: 14px; font-weight: 700; color: #475569; width: 35%;">NAMA LENGKAP SISWA</th>
                            <th style="padding: 14px; font-weight: 700; color: #475569; width: 25%;">USERNAME</th>
                            <th style="padding: 14px; font-weight: 700; color: #475569; width: 35%; text-align: center;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                        <tr style="border-bottom: 1px solid #F1F5F9; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#F8FAFC'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 16px 14px; font-weight: 600; color: #94A3B8;">{{ $index + 1 }}</td>
                            
                            <td style="padding: 16px 14px; font-weight: 700; color: #1E293B;">{{ $s->nama_lengkap }}</td>
                            
                            <td style="padding: 16px 14px; font-weight: 600; color: #64748B;">
                                {{ $s->user->username ?? '-' }}
                            </td>
                            
                            <td style="padding: 16px 14px; text-align: center;">
                                <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                                    
                                    <button type="button" 
                                            onclick="intipAkun('{{ $s->nama_lengkap }}', '{{ $s->user->username ?? '-' }}', '{{ $s->nis }}')"
                                            style="background: #EFF6FF; color: #2563EB; border: none; padding: 8px 14px; border-radius: 10px; font-weight: 700; cursor: pointer; font-size: 13px;">
                                        👁️ Detail Akun
                                    </button>

                                    <a href="/users" style="background: #FEF3C7; color: #D97706; padding: 8px 14px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13px;">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('users.siswa.destroy', $s->nis) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $s->nama_lengkap }} beserta akun loginnya secara permanen?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #FEE2E2; color: #DC2626; border: none; padding: 8px 14px; border-radius: 10px; font-weight: 700; cursor: pointer; font-size: 13px;">
                                            🗑️ Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 40px; text-align: center; color: #94A3B8; font-weight: 600;">
                                Belum ada data siswa terdaftar di dalam kelas ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div id="modalIntipAkun" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 9999; justify-content: center; align-items: center;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 90%; max-width: 400px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
            <h3 style="margin-top: 0; color: #1E293B; font-size: 20px; font-weight: 800;" id="modalNamaSiswa">Detail Akun</h3>
            <p style="font-size: 13px; color: #64748B; margin-top: -5px; margin-bottom: 20px;">Informasi kredensial login bersifat rahasia.</p>
            
            <div style="margin-bottom: 16px;">
                <label style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Username</label>
                <input type="text" id="modalUsername" readonly style="width: 100%; padding: 12px; border: 1.5px solid #E2E8F0; border-radius: 10px; background: #F8FAFC; font-weight: 700; margin-top: 6px; color: #334155; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Password Bawaan (NIS)</label>
                <div style="position: relative; display: flex; margin-top: 6px;">
                    <input type="password" id="modalPassword" readonly style="width: 100%; padding: 12px; border: 1.5px solid #E2E8F0; border-radius: 10px; background: #F8FAFC; font-weight: 700; color: #334155; box-sizing: border-box; padding-right: 45px;">
                    <button type="button" onclick="togglePassword()" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 16px; padding: 0;">
                        👁️
                    </button>
                </div>
            </div>

            <button type="button" onclick="tutupModal()" style="width: 100%; padding: 14px; background: #1E293B; color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; font-size: 14px; transition: background 0.2s;">
                Tutup Log Akun
            </button>
        </div>
    </div>

    <script>
    function intipAkun(nama, username, passwordDefault) {
        document.getElementById('modalNamaSiswa').innerText = nama;
        document.getElementById('modalUsername').value = username;
        document.getElementById('modalPassword').value = passwordDefault; // NIS murid diset sebagai password default bawaan
        document.getElementById('modalPassword').type = 'password'; // Otomatis disembunyikan dalam bentuk bintang-bintang saat pop-up terbuka
        document.getElementById('modalIntipAkun').style.display = 'flex';
    }

    function tutupModal() {
        document.getElementById('modalIntipAkun').style.display = 'none';
    }

    function togglePassword() {
        var passInput = document.getElementById('modalPassword');
        if (passInput.type === 'password') {
            passInput.type = 'text';
        } else {
            passInput.type = 'password';
        }
    }
    </script>
</body>
</html>