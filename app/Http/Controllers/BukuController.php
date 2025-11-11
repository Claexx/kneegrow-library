<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('penulis', 'like', "%$search%");
        }
    
        $books = $query->latest()->paginate(12);
    
        return view('public.books', compact('books'));
    }

    public function admin(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('penulis', 'like', "%$search%");
        }
    
        $books = $query->latest()->paginate(12);
    
        return view('admin.buku.index', compact('books'));
    }

    public function lp(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('penulis', 'like', "%$search%");
        }
    
        $books = $query->latest()->paginate(12);
    
        return view('public.landing-page', compact('books'));
    }

    public function create()
    {
        return view('admin.buku.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'kategori' => 'required|string',
            'stok' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun', 'kategori', 'stok']);

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('books', $fileName, 'public');
            $data['image'] = $path;
        }

        Book::create($data);

        return redirect('/bukuadmin')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.buku.detail', compact('book'));
    }

    // 🔥 Tambahan method destroy
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        // Hapus data buku dari database
        $book->delete();

        return redirect('/bukuadmin')->with('success', 'Buku berhasil dihapus!');
    }
}
