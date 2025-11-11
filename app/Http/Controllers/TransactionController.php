<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Halaman daftar transaksi (Admin)
    public function index()
    {
        $transactions = Transaction::with(['user', 'book'])->latest()->get();
        return view('admin.transaksi.index', compact('transactions'));
    }

    // Form tambah transaksi (Admin)
    public function create()
    {
        $users = User::all();
        $books = Book::all();
        return view('admin.transaksi.tambah', compact('users', 'books'));
    }

    // Simpan transaksi baru (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
        ]);

        Transaction::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Dipinjam',
        ]);

        return redirect('/transaksiadmin')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Ubah status jadi dikembalikan
    public function update($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'status' => 'Dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }

    // Hapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }

    // User klik "Pinjam" di halaman public
    public function borrow($bookId)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->withErrors(['akses' => 'Anda harus login untuk meminjam buku.']);
        }

        $existing = Transaction::where('book_id', $bookId)
            ->where('user_id', $user->id)
            ->where('status', 'Dipinjam')
            ->first();

        if ($existing) {
            return back()->withErrors(['akses' => 'Anda sudah meminjam buku ini dan belum mengembalikannya.']);
        }

        Transaction::create([
            'user_id' => $user->id,
            'book_id' => $bookId,
            'tanggal_pinjam' => now(),
            'status' => 'Dipinjam',
        ]);

        return back()->with('success', 'Buku berhasil dipinjam!');
    }
}
