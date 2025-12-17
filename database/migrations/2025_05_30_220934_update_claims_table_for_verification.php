<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClaimsTableForVerification extends Migration
{
    public function up()
    {
        Schema::table('claims', function (Blueprint $table) {
            // Ubah kolom verified jadi integer status klaim
            $table->tinyInteger('verified')->default(0)->comment('0=pending, 1=approved, 2=rejected')->change();

            // Pastikan claimed_at nullable (bisa null kalau belum diklaim)
            $table->timestamp('claimed_at')->nullable()->change();

            // Kolom message sudah sesuai untuk simpan jawaban klaim
            // Jika ingin rename jadi answer, bisa diubah seperti ini:
            // $table->renameColumn('message', 'answer');
        });
    }

    public function down()
    {
        Schema::table('claims', function (Blueprint $table) {
            // Rollback perubahan ke kolom verified sebelumnya
            $table->boolean('verified')->default(false)->change();

            // claimed_at jika ingin rollback ke nullable atau default
            $table->timestamp('claimed_at')->nullable()->change();

            // Rename answer ke message jika ada perubahan rename
            // $table->renameColumn('answer', 'message');
        });
    }
}

