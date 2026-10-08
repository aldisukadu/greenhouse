# Tahap 5 - Pembersihan dan penyelesaian deposit

Deposit kini untuk biaya pembersihan lahan di akhir peminjaman.
Perawatan tanaman oleh peminjam hanya catatan opsional tanpa sanksi.

## Hapus file lama
- app/Http/Controllers/Admin/PerawatanController.php

## Pasang
Salin folder `app`, `config`, `database`, `resources`, `routes`, `tests` ke proyek (pilih replace).
Dua migration lama diubah, jadi database harus dibuat ulang:

    php artisan migrate:fresh --seed
    php artisan test
    npm run build

Gunakan `php artisan storage:link` hanya jika belum pernah dijalankan.

## Alur
peminjam: aktif -> kembalikan (kondisi + foto wajib) -> menunggu_pemeriksaan
admin: periksa -> catat pembersihan + biaya (jika kotor) -> selesaikan deposit -> dikembalikan
Tidak dikembalikan sampai batas_kembali_hari setelah tanggal_selesai: admin menandai dikembalikan.
