<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barang_id')
                  ->constrained('barangs')
                  ->cascadeOnDelete();

            $table->enum('tipe', ['persen', 'nominal']);

            $table->decimal('nilai', 12, 2);

            $table->date('mulai');
            $table->date('selesai');

            // status DISIMPAN, tapi DIHITUNG otomatis
            $table->boolean('aktif')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diskons');
    }
};
