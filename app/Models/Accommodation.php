<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel.
     */
    protected $table = 'accommodations';

    /**
     * Kolom yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        // Relasi kategori
        'category_id',

        // Informasi penginapan
        'title',
        'slug',
        'thumbnail',

        // Harga
        'price',

        // Lokasi
        'address',
        'maps_embed',
        'google_maps_url',

        // Kontak
        'phone',
        'whatsapp',
        'email',

        // Sosial Media
        'facebook',
        'instagram',
        'youtube',
        'x',
        'tiktok',

        // Detail penginapan
        'capacity',
        'bedroom',
        'bathroom',
        'size',

        // Status
        'status',

        // Deskripsi
        'description',

        // SEO
        'meta_title',
        'meta_description',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'capacity' => 'integer',
        'bedroom' => 'integer',
        'bathroom' => 'integer',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke kategori akomodasi.
     *
     * Satu accommodation memiliki satu category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            AccommodationCategory::class,
            'category_id'
        );
    }

    /**
     * Relasi ke gambar accommodation.
     *
     * Satu accommodation dapat memiliki banyak gambar.
     */
    public function images(): HasMany
    {
        return $this->hasMany(
            AccommodationImage::class,
            'accommodation_id'
        )->orderBy('sort_order');
    }

    /**
     * Relasi ke fasilitas.
     *
     * Satu accommodation dapat memiliki banyak facility.
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(
            Facility::class,
            'accommodation_facilities',
            'accommodation_id',
            'facility_id'
        )->withTimestamps();
    }

    /**
     * Relasi ke aturan.
     *
     * Satu accommodation dapat memiliki banyak rule.
     */
    public function rules(): BelongsToMany
    {
        return $this->belongsToMany(
            Rule::class,
            'accommodation_rules',
            'accommodation_id',
            'rule_id'
        )->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    | Memudahkan menampilkan link kontak yang siap diklik.
    */

    /**
     * URL WhatsApp yang siap diklik.
     */
    public function getWhatsappUrlAttribute(): ?string
    {
        if (empty($this->whatsapp)) {
            return null;
        }

        $clean = preg_replace('/[^0-9]/', '', $this->whatsapp);

        return $clean ? 'https://wa.me/' . $clean : null;
    }

    /**
     * URL Telepon yang siap diklik.
     */
    public function getPhoneUrlAttribute(): ?string
    {
        if (empty($this->phone)) {
            return null;
        }

        $clean = preg_replace('/[^0-9+]/', '', $this->phone);

        return $clean ? 'tel:' . $clean : null;
    }

    /**
     * URL Email yang siap diklik.
     */
    public function getEmailUrlAttribute(): ?string
    {
        return !empty($this->email) ? 'mailto:' . $this->email : null;
    }

    /*
    |--------------------------------------------------------------------------
    | Helper
    |--------------------------------------------------------------------------
    | Untuk cek apakah data kontak / sosial media tersedia.
    */

    /**
     * Cek apakah accommodation punya kontak.
     */
    public function hasContact(): bool
    {
        return !empty($this->phone)
            || !empty($this->whatsapp)
            || !empty($this->email);
    }

    /**
     * Cek apakah accommodation punya sosial media.
     */
    public function hasSocialMedia(): bool
    {
        return !empty($this->facebook)
            || !empty($this->instagram)
            || !empty($this->youtube)
            || !empty($this->x)
            || !empty($this->tiktok);
    }
}