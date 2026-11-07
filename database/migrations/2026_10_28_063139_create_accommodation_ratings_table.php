
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
        Schema::create('accommodation_ratings', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi Penginapan
            |--------------------------------------------------------------------------
            */
            $table->foreignId('accommodation_id')
                ->constrained('accommodations')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Informasi Pengulas
            |--------------------------------------------------------------------------
            */
            $table->string('nama');
            $table->string('email');
            
            /*
            |--------------------------------------------------------------------------
            | Rating dan Keterangan
            |--------------------------------------------------------------------------
            */
            $table->unsignedTinyInteger('bintang');
            $table->text('keterangan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Timestamp
            |--------------------------------------------------------------------------
            */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation_ratings');
    }
};
