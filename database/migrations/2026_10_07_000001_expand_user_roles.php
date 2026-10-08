<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pekerja', 'peminjam'])->default('peminjam')->change();
        });

        DB::table('users')->where('role', 'admin')->update(['role' => 'pekerja']);
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'pekerja')->update(['role' => 'admin']);

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'peminjam'])->default('peminjam')->change();
        });
    }
};