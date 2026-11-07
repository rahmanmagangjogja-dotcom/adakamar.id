<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi Kategori
            |--------------------------------------------------------------------------
            */
            $table->foreignId('category_id')
                ->constrained('accommodation_categories')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Informasi Penginapan
            |--------------------------------------------------------------------------
            */
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail');

            /*
            |--------------------------------------------------------------------------
            | Harga
            |--------------------------------------------------------------------------
            */
            $table->decimal('price', 12, 2);

            /*
            |--------------------------------------------------------------------------
            | Lokasi
            |--------------------------------------------------------------------------
            */
            $table->string('address');

            // Google Maps Embed
            $table->longText('maps_embed')->nullable();

            // Link Google Maps
            $table->string('google_maps_url')->nullable();


            /*
            |--------------------------------------------------------------------------
            | Kontak Penginapan
            |--------------------------------------------------------------------------
            */
            $table->string('phone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('email')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Sosial Media
            |--------------------------------------------------------------------------
            | Semua nullable — boleh dikosongi jika tidak ada.
            */
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('x')->nullable();
            $table->string('tiktok')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Detail Penginapan
            |--------------------------------------------------------------------------
            */
            $table->integer('capacity')->default(1);
            $table->integer('bedroom')->default(1);
            $table->integer('bathroom')->default(1);

            $table->string('size')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'Available',
                'Full',
                'Maintenance',
            ])->default('Available');

            /*
            |--------------------------------------------------------------------------
            | Deskripsi
            |--------------------------------------------------------------------------
            */
            $table->longText('description');

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Timestamp & Soft Delete
            |--------------------------------------------------------------------------
            */
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};