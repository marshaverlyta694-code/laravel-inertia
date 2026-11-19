<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    // Menampilkan semua post terbaru pada halaman daftar.
    /** 
     * index
     * @return void 
     */
    public function index()
    {
        // Mengambil seluruh post dan mengurutkannya dari yang paling baru.
        $posts = Post::latest()->get();

        // Merender halaman Inertia dan mengirim data post agar dapat ditampilkan.
        return Inertia::render('Post/Index', [
            'posts' => $posts
        ]);
    }

    // Menampilkan formulir untuk membuat post baru.
    /** 
     * create 
     * @return void 
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    // Memvalidasi lalu menyimpan post baru dari data formulir.
    /** 
     * store 
     * @param  mixed $request
     * @return void 
     */
    public function store(Request $request)
    {
        // Judul dan isi wajib diisi; jika tidak valid Laravel mengembalikan pesan kesalahan.
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        // Membuat record post menggunakan nilai yang dikirim dari formulir.
        $post = Post::create([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        // Setelah berhasil disimpan, kembali ke dashboard dengan pesan untuk pengguna.
        if($post) {
            return Redirect::route('dashboard')->with('message', 'Data Berhasil Disimpan!');
        }
    }

    // Menampilkan formulir edit beserta data post yang dipilih.
    /** 
     * edit  
     * @param  mixed $post
     * @return void 
     */
    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }

    // Memvalidasi perubahan lalu memperbarui post yang dipilih.
    /** 
     * update  
     * @param  mixed $request
     * @param  mixed $post
     * @return void 
     */
    public function update(Request $request, Post $post)
    {
        // Pastikan kedua kolom tetap terisi sebelum perubahan disimpan.
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        // Memperbarui judul dan isi pada post yang ditemukan melalui model binding.
        $post->update([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        // Kembali ke dashboard dan menyampaikan bahwa perubahan berhasil.
        if($post) {
            return Redirect::route('dashboard')->with('message', 'Data Berhasil Diupdate!');
        }
    }

    // Menghapus post berdasarkan ID yang diterima dari route.
    /** 
     * destroy 
     * @param  mixed $id
     * @return void 
     */
    public function destroy($id)
    {
        // Mencari post; findOrFail menghasilkan respons 404 jika ID tidak ditemukan.
        $post = Post::findOrFail($id);

        // Menghapus record post dari database.
        $post->delete();

        // Kembali ke dashboard dan menyampaikan bahwa post berhasil dihapus.
        if($post) {
            return Redirect::route('dashboard')->with('message', 'Data Berhasil Dihapus!');
        }
    }
}