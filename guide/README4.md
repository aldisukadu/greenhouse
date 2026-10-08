# Tahap 4 - Pembayaran deposit dan perawatan

Salin folder `app`, `config`, `resources`, `routes`, `tests` ke proyek (pilih replace).
File tahap sebelumnya yang tertimpa:
- config/greenhouse.php
- routes/web.php
- resources/views/peminjam/peminjamans/show.blade.php
- resources/views/admin/peminjamans/show.blade.php

Dari dalam folder proyek:

    php artisan storage:link
    php artisan test
    npm run build

Tidak ada migration baru.

Upload: foto perawatan -> disk `public` (bisa dibuka lewat /storage/...).
Bukti bayar -> disk `local` (privat), hanya lewat route /bukti-bayar/{id}
yang dicek hak aksesnya (pemilik atau admin).

Jika upload gagal untuk foto besar, naikkan di php.ini:
    upload_max_filesize = 8M
    post_max_size = 10M
(Laragon: klik kanan Laragon > PHP > php.ini, lalu restart Apache).
