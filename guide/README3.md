# Tahap 3 - Lahan, pengajuan, persetujuan

Salin folder `app`, `config`, `resources`, `routes`, `tests` ke proyek (pilih replace).
File yang MENIMPA milik tahap sebelumnya: `routes/web.php`, `resources/views/admin/dashboard.blade.php`,
`resources/views/peminjam/dashboard.blade.php`.

Jalankan dari dalam folder proyek:

    php artisan test
    npm run build

Tidak ada migration baru, jadi tidak perlu migrate ulang.

Atur zona waktu di `.env`: APP_TIMEZONE=Asia/Jakarta
(Laravel 10 ke bawah: ubah 'timezone' di config/app.php).

## Isi
- Admin: CRUD green house dan lahan, daftar + detail peminjaman, setujui/tolak.
- Peminjam: daftar lahan + cek ketersediaan per rentang tanggal, ajukan, riwayat, detail.
- app/Services/PeminjamanService.php: ajukan, setujui, tolak (transaksi + kunci baris lahan).
- config/greenhouse.php: 48 jam batas bayar, 3 hari peringatan, 2 hari menuju terabaikan.
