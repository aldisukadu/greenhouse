# Tahap 1 - Migration, Model, Seeder

## Pasang
```bash
composer create-project laravel/laravel greenhouse
cd greenhouse
composer require laravel/breeze --dev
php artisan breeze:install blade
```
1. Atur DB di `.env` (DB_CONNECTION=mysql, DB_DATABASE=greenhouse, dsb), buat database kosong di phpMyAdmin.
2. Salin isi folder ini ke proyek (`app/Models/*` MENIMPA `User.php` bawaan; migration dan seeder ditambahkan).
3. Tambahkan di `.env`: `APP_INSTANSI="Nama Instansi Anda"` dan di `config/app.php`:
   `'instansi' => env('APP_INSTANSI', 'Nama Instansi'),`
4. Jalankan:
```bash
php artisan migrate:fresh --seed
```
Akun demo (password: `password`): admin@example.com, peminjam@example.com

## Verifikasi cepat (php artisan tinker)
```php
App\Models\Lahan::count();            // 8
App\Models\User::where('role','admin')->count(); // 1
```
