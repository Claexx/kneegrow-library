<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
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
            Transaction::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'tanggal_pinjam' => Carbon::now()->toDateString(),
                'status' => 'Dipinjam'
            ]);

            $book->decrement('stok');

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
            Transaction::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'tanggal_pinjam' => Carbon::now()->toDateString(),
                'status' => 'Dipinjam'
            ]);

            $book->decrement('stok');

            return back()->with('success', 'Buku berhasil dipinjam');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function kembalikan(Transaction $transaction)
    {
        try {
            $transaction->update([
                'status' => 'Dikembalikan',
                'tanggal_kembali' => Carbon::now()->toDateString()
            ]);

            $transaction->book->increment('stok');

            return back()->with('success', 'Buku dikembalikan!');
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
            $transaction->update([
                'status' => 'Dikembalikan',
                'tanggal_kembali' => Carbon::now()->toDateString(),
            ]);

            $transaction->book->increment('stok');

            return back()->with('success', 'Buku berhasil dikembalikan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
