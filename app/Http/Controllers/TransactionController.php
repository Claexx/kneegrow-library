<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
use App\Notifications\TransactionNotification;
use App\Notifications\FineNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $transaksi = Transaction::with(['user', 'book'])->latest()->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $users = User::where('is_admin', false)->get();
        $books = Book::where('stok', '>', 0)->get();

        return view('admin.transaksi.tambah', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id'
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stok < 1) {
            return back()->with('error', 'Stok buku tidak cukup');
        }

        try {
            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'tanggal_pinjam' => Carbon::now()->toDateString(),
                'tanggal_deadline' => Carbon::now()->addDays(7)->toDateString(),
                'status' => 'Dipinjam'
            ]);

            $book->decrement('stok');

            // Kirim notifikasi ke user
            $user = User::findOrFail($request->user_id);
            $user->notify(new TransactionNotification(
                "Buku '{$book->judul}' berhasil dipinjam. Deadline pengembalian: " . Carbon::parse($transaction->tanggal_deadline)->format('d/m/Y'),
                'success'
            ));

            // Kirim notifikasi ke admin
            $admin = User::where('is_admin', true)->first();
            if ($admin) {
                $admin->notify(new TransactionNotification(
                    "User '{$user->name}' telah meminjam buku '{$book->judul}'",
                    'info'
                ));
            }

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function borrow($id)
    {
        $book = Book::findOrFail($id);

        if ($book->stok < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        try {
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'tanggal_pinjam' => Carbon::now()->toDateString(),
                'tanggal_deadline' => Carbon::now()->addDays(7)->toDateString(),
                'status' => 'Dipinjam'
            ]);

            $book->decrement('stok');

            // Kirim notifikasi ke user
            auth()->user()->notify(new TransactionNotification(
                "Buku '{$book->judul}' berhasil dipinjam. Deadline pengembalian: " . Carbon::parse($transaction->tanggal_deadline)->format('d/m/Y'),
                'success'
            ));

            // Kirim notifikasi ke admin
            $admin = User::where('is_admin', true)->first();
            if ($admin) {
                $admin->notify(new TransactionNotification(
                    "User '" . auth()->user()->name . "' telah meminjam buku '{$book->judul}'",
                    'info'
                ));
            }

            return back()->with('success', 'Buku berhasil dipinjam');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function kembalikan(Transaction $transaction)
    {
        try {
            // Hitung denda
            $denda = $transaction->hitungDenda();
            $hari_terlambat = $transaction->hitungHariTerlambat();

            $transaction->update([
                'status' => 'Dikembalikan',
                'tanggal_kembali' => Carbon::now()->toDateString(),
                'denda' => $denda,
                'hari_terlambat' => $hari_terlambat,
            ]);

            $transaction->book->increment('stok');

            // Kirim notifikasi ke user
            $message = "Buku '{$transaction->book->judul}' berhasil dikembalikan.";
            $type = 'success';

            if ($denda > 0) {
                $message = "Buku '{$transaction->book->judul}' dikembalikan dengan terlambat {$hari_terlambat} hari. Denda: Rp " . number_format($denda, 0, ',', '.');
                $type = 'warning';
                
                // Kirim notifikasi denda khusus
                $transaction->user->notify(new FineNotification($transaction, $denda, $hari_terlambat));
            }

            $transaction->user->notify(new TransactionNotification($message, $type));

            // Kirim notifikasi ke admin
            $admin = User::where('is_admin', true)->first();
            if ($admin) {
                $admin->notify(new TransactionNotification(
                    "User '{$transaction->user->name}' mengembalikan buku '{$transaction->book->judul}'" . ($denda > 0 ? " (Denda: Rp " . number_format($denda, 0, ',', '.') . ")" : ""),
                    $denda > 0 ? 'warning' : 'success'
                ));
            }

            return back()->with('success', 'Buku dikembalikan!' . ($denda > 0 ? ' Denda: Rp ' . number_format($denda, 0, ',', '.') : ''));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function activity()
    {
        $transaksi = Transaction::with(['book'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('public.activity', compact('transaksi'));
    }

    public function userReturn(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            // Hitung denda
            $denda = $transaction->hitungDenda();
            $hari_terlambat = $transaction->hitungHariTerlambat();

            $transaction->update([
                'status' => 'Dikembalikan',
                'tanggal_kembali' => Carbon::now()->toDateString(),
                'denda' => $denda,
                'hari_terlambat' => $hari_terlambat,
            ]);

            $transaction->book->increment('stok');

            // Kirim notifikasi ke user
            $message = "Buku '{$transaction->book->judul}' berhasil dikembalikan.";
            $type = 'success';

            if ($denda > 0) {
                $message = "Buku '{$transaction->book->judul}' dikembalikan dengan terlambat {$hari_terlambat} hari. Denda: Rp " . number_format($denda, 0, ',', '.');
                $type = 'warning';
                
                // Kirim notifikasi denda khusus
                $transaction->user->notify(new FineNotification($transaction, $denda, $hari_terlambat));
            }

            auth()->user()->notify(new TransactionNotification($message, $type));

            // Kirim notifikasi ke admin
            $admin = User::where('is_admin', true)->first();
            if ($admin) {
                $admin->notify(new TransactionNotification(
                    "User '" . auth()->user()->name . "' mengembalikan buku '{$transaction->book->judul}'" . ($denda > 0 ? " (Denda: Rp " . number_format($denda, 0, ',', '.') . ")" : ""),
                    $denda > 0 ? 'warning' : 'success'
                ));
            }

            return back()->with('success', 'Buku berhasil dikembalikan!' . ($denda > 0 ? ' Denda: Rp ' . number_format($denda, 0, ',', '.') : ''));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}

