<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda',
        'hari_terlambat',
        'tanggal_deadline',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Hitung denda berdasarkan keterlambatan
     * Denda Rp 5000 per hari
     */
    public function hitungDenda()
    {
        if ($this->status !== 'Dikembalikan' || !$this->tanggal_kembali) {
            return 0;
        }

        $tanggal_batas = Carbon::parse($this->tanggal_pinjam)->addDays(7); // 7 hari untuk peminjaman
        $tanggal_kembali = Carbon::parse($this->tanggal_kembali);

        if ($tanggal_kembali->greaterThan($tanggal_batas)) {
            $hari_terlambat = $tanggal_kembali->diffInDays($tanggal_batas);
            return $hari_terlambat * 5000; // Rp 5000 per hari
        }

        return 0;
    }

    /**
     * Hitung hari keterlambatan
     */
    public function hitungHariTerlambat()
    {
        if ($this->status !== 'Dikembalikan' || !$this->tanggal_kembali) {
            return 0;
        }

        $tanggal_batas = Carbon::parse($this->tanggal_pinjam)->addDays(7);
        $tanggal_kembali = Carbon::parse($this->tanggal_kembali);

        if ($tanggal_kembali->greaterThan($tanggal_batas)) {
            return $tanggal_kembali->diffInDays($tanggal_batas);
        }

        return 0;
    }

    /**
     * Hitung status keterlambatan
     */
    public function isOverdue()
    {
        if ($this->status === 'Dikembalikan') {
            return false;
        }

        $tanggal_batas = Carbon::parse($this->tanggal_pinjam)->addDays(7);
        return Carbon::now()->greaterThan($tanggal_batas);
    }

    /**
     * Hitung sisa hari sebelum terlambat
     */
    public function sisaHari()
    {
        if ($this->status === 'Dikembalikan') {
            return 0;
        }

        $tanggal_batas = Carbon::parse($this->tanggal_pinjam)->addDays(7);
        $hari = Carbon::now()->diffInDays($tanggal_batas, false);
        return $hari >= 0 ? $hari : 0;
    }
}
