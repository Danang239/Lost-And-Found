<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom features ke tabel items
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->text('features')->nullable()->after('description'); // Tambah kolom ciri-ciri
        });
    }

    /**
     * Hapus kolom features jika rollback
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('features');
        });
    }
};
