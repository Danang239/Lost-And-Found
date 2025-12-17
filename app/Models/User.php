<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Klaim yang dibuat oleh user (pengklaim)
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    // Klaim yang masuk ke user sebagai pemilik barang melalui relasi item
    public function claimsReceived()
    {
        return $this->hasManyThrough(Claim::class, Item::class, 'user_id', 'item_id');
    }

    // Barang yang didaftarkan user
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_admin',
        'role',

        // ========== Preferensi Notifikasi ==========
        'notify_claim_via_email',
        'notify_claim_status',
        'notify_campus_info',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at'      => 'datetime',
        'is_admin'               => 'boolean',
        
        // ========== Casting preferensi ke boolean ==========
        'notify_claim_via_email' => 'boolean',
        'notify_claim_status'    => 'boolean',
        'notify_campus_info'     => 'boolean',

        'password'               => 'hashed',
    ];

    /**
     * Check if user is admin.
     */
    public function isAdmin()
    {
        return $this->is_admin === 1;
    }
}
