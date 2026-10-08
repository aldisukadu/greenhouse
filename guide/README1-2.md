# Tahap 1-2

Salin folder `app`, `database`, `resources`, `routes`, `tests` ke proyek (pilih replace).
Lalu dari dalam folder proyek:

    php artisan migrate:fresh --seed
    php artisan test --filter=RoleAccessTest
    npm run build

Akun demo (password `password`): admin@example.com, peminjam@example.com
