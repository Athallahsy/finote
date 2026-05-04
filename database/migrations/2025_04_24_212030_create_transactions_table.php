<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('judul');
            $table->integer('jumlah');
            $table->date('tanggal');
<<<<<<< HEAD
            $table->enum('jenis', ['income', 'expense']);
=======
            $table->enum('jenis', ['income', 'expanse']);
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
