# Sistem Denda dan Notifikasi - Dokumentasi Implementasi

## Fitur yang Telah Diimplementasikan

### 1. **Sistem Denda (Fine System)**
- **Denda Otomatis**: Ketika buku dikembalikan lebih dari 7 hari sejak peminjaman, sistem akan menghitung denda
- **Tarif Denda**: Rp 5.000 per hari keterlambatan
- **Contoh**: Buku dipinjam 7 hari, dikembalikan 10 hari = 3 hari terlambat = Rp 15.000

### 2. **Sistem Notifikasi Terintegrasi**
- **Notifikasi Real-time**: Notifikasi muncul di setiap halaman (admin dan publik)
- **Tipe Notifikasi**: 
  - 🟢 Success (Hijau) - Peminjaman/Pengembalian sukses
  - 🔴 Error (Merah) - Kesalahan sistem
  - 🟡 Warning (Kuning) - Keterlambatan/Denda
  - 🔵 Info (Biru) - Informasi umum

- **Penerima Notifikasi**:
  - Peminjam: Notifikasi peminjaman, pengembalian, dan denda
  - Admin: Notifikasi aktivitas pengguna dan denda yang dibayarkan

### 3. **Database Changes**
Migration baru ditambahkan ke tabel `transactions`:
- `denda` (decimal) - Jumlah denda dalam rupiah
- `hari_terlambat` (integer) - Jumlah hari keterlambatan
- `tanggal_deadline` (date) - Deadline pengembalian buku

Tabel baru `notifications` untuk menyimpan notifikasi database:
- `id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`

### 4. **Fitur di Interface Admin**
- **Transaksi Index**: 
  - Menampilkan denda per transaksi
  - Menampilkan deadline pengembalian
  - Highlight transaksi dengan denda
  
- **Halaman Notifikasi**: 
  - Menampilkan semua notifikasi dari sistem
  - Menampilkan rincian denda untuk transaksi terlambat
  - Tombol untuk menandai sebagai dibaca

### 5. **Fitur di Interface Publik (User)**
- **Halaman Activity**:
  - Menampilkan status keterlambatan (jika ada)
  - Menampilkan sisa hari sebelum deadline
  - Menampilkan jumlah denda jika terlambat
  - Tombol kembalikan dengan highlight jika terlambat

## Cara Kerja Sistem

### Proses Peminjaman Buku
1. User/Admin membuat transaksi peminjaman
2. Sistem otomatis menghitung `tanggal_deadline` = `tanggal_pinjam` + 7 hari
3. Notifikasi dikirim ke user dan admin

### Proses Pengembalian Buku
1. User/Admin mengklik tombol "Kembalikan"
2. Sistem mengecek apakah `tanggal_kembali` > `tanggal_deadline`
3. Jika terlambat, hitung: `denda = (tanggal_kembali - tanggal_deadline) * 5000`
4. Simpan denda ke database
5. Kirim notifikasi ke user dengan detail denda
6. Kirim notifikasi ke admin tentang transaksi

## Model dan Method Baru

### Transaction Model
```php
- hitungDenda()          // Hitung total denda
- hitungHariTerlambat()  // Hitung hari keterlambatan
- isOverdue()            // Cek apakah masih terlambat
- sisaHari()             // Hitung sisa hari sebelum deadline
```

### Notification Classes
- `TransactionNotification` - Notifikasi transaksi umum
- `FineNotification` - Notifikasi khusus untuk denda

## File yang Dimodifikasi/Dibuat

### Dibuat Baru:
- `app/Notifications/TransactionNotification.php`
- `app/Notifications/FineNotification.php`
- `resources/views/components/notification-display.blade.php`
- `database/migrations/2026_04_22_add_denda_to_transactions.php`
- `database/migrations/2026_04_22_create_notifications_table.php`

### Dimodifikasi:
- `app/Models/Transaction.php` - Tambah denda fields & methods
- `app/Models/User.php` - Fix relationship
- `app/Http/Controllers/TransactionController.php` - Tambah logika denda & notifikasi
- `resources/views/template/layout.blade.php` - Tambah notification display
- `resources/views/template/layout-admin.blade.php` - Tambah notification display
- `resources/views/admin/notifikasi.blade.php` - Ganti demo dengan real notifications
- `resources/views/admin/transaksi/index.blade.php` - Tampilkan denda
- `resources/views/public/activity.blade.php` - Tampilkan denda & overdue status
- `routes/web.php` - Tambah API notifications endpoint

## Testing Fitur

1. **Test Peminjaman**: Pinjam buku, lihat notifikasi muncul
2. **Test Denda**: Ubah `tanggal_kembali` di database untuk test denda
3. **Test Notifikasi**: Lihat notifikasi di halaman admin dan publik
4. **Test Deadline**: Cek apakah deadline dihitung dengan benar (pinjam date + 7 hari)

## Catatan Penting

- Sistem denda dihitung otomatis saat pengembalian buku
- Notifikasi disimpan di database dan dapat dilihat kapan saja
- Notifikasi real-time ditampilkan di setiap halaman
- Deadline peminjaman adalah 7 hari dari tanggal peminjaman
- Denda hanya dihitung untuk hari keterlambatan, bukan total hari peminjaman
