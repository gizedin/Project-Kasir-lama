<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('akun') 
                  ->cascadeOnDelete();

            $table->foreignId('barang_id')
                  ->constrained('barangs')
                  ->cascadeOnDelete();

            $table->integer('qty')->default(1);

            $table->decimal('harga_asli', 12, 2);
            $table->decimal('diskon', 12, 2)->default(0);
            $table->decimal('harga_final', 12, 2);

            $table->string('payment');
            $table->enum('status', ['success', 'failed']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
