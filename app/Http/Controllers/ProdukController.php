<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\JsonEncodingException;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        foreach ($produks as $produk) {
            $produk->gambar = base64_encode($produk->gambar);
        }
        return response()->json($produks);

    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|string',
            'kontak'      => 'required|string',
            'gambar'      => 'required|file|mimes:jpg,jpeg,png'
        ]);

        try {
            $gambar = file_get_contents($request->file('gambar')->getRealPath());

            $produk = Produk::create([
                'nama_produk' => $request->nama_produk,
                'deskripsi'   => $request->deskripsi,
                'harga'       => $request->harga,
                'kontak'      => $request->kontak,
                'gambar'      => $gambar
            ]);

            // Coba encode ke JSON
            return response()->json($produk, 201);

        } catch (JsonEncodingException $e) {
            return response()->json([
                'message' => 'Produk berhasil diunggah ke database, tetapi data gambar tidak dapat ditampilkan di response JSON.',
                'produk_id' => $produk->id
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan produk.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $produk->gambar = base64_encode($produk->gambar);

        return response()->json($produk);
    }


    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        // Validasi data
        $request->validate([
            'nama_produk' => 'sometimes|string',
            'deskripsi'   => 'sometimes|string',
            'harga'       => 'sometimes|string',
            'kontak'      => 'sometimes|string',
            'gambar'      => 'sometimes|file|mimes:jpg,jpeg,png'
        ]);

        // Update kolom biasa
        $produk->nama_produk = $request->input('nama_produk', $produk->nama_produk);
        $produk->deskripsi   = $request->input('deskripsi', $produk->deskripsi);
        $produk->harga       = $request->input('harga', $produk->harga);
        $produk->kontak      = $request->input('kontak', $produk->kontak);

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambar = file_get_contents($request->file('gambar')->getRealPath());
            $produk->gambar = $gambar;
        }

        $produk->save();

        // Encode gambar agar bisa di-JSON-kan
        $produk->gambar = base64_encode($produk->gambar);

        return response()->json($produk);
    }


    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
        $produk->delete();
        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
