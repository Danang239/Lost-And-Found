<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAdminToUsersTable extends Migration
{
    /**
     * Menambahkan kolom is_admin ke tabel users.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom is_admin dengan tipe boolean dan default false
            $table->boolean('is_admin')->default(false)->after('password');
        });
    }

    /**
     * Membatalkan perubahan yang telah dibuat di metode up.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom is_admin jika rollback dilakukan
            $table->dropColumn('is_admin');
        });
    }
}
