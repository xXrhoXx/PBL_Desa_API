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
            'nama'    => 'required|string',
            'jabatan' => 'required|string',
            'kontak'  => 'required|string',
            'foto'    => 'required|file|mimes:jpg,jpeg,png'
        ]);

        try {
            // Ambil file foto lalu konversi ke binary
            $foto = file_get_contents($request->file('foto')->getRealPath());

            $perangkat = PerangkatDesa::create([
                'nama'    => $request->nama,
                'jabatan' => $request->jabatan,
                'kontak'  => $request->kontak,
                'foto'    => $foto
            ]);

            return response()->json($perangkat, 201);

        } catch (JsonEncodingException $e) {
            return response()->json([
                'message'     => 'Data berhasil diunggah ke database, tetapi gambar tidak bisa ditampilkan di response JSON.',
                'perangkat_id' => $perangkat->id
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data perangkat.',
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

        $produk->gambar = 'data:image/jpeg;base64,' . base64_encode($produk->gambar);

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
        $produk->gambar = 'data:image/jpeg;base64,' . base64_encode($produk->gambar);

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

    public function produkPublic()
    {
        $produks = Produk::all();
        foreach ($produks as $produk) {
            $produk->gambar = base64_encode($produk->gambar);
        }
        return response()->json($produks);
    }

}
