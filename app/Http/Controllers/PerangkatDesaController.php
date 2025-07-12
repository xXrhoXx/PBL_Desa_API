<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        return response()->json(PerangkatDesa::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string',
            'jabatan' => 'required|string',
            'kontak'  => 'required|string',
            'foto'    => 'required|file|mimes:jpg,jpeg,png'
        ]);

        $data = $request->only(['nama', 'jabatan', 'kontak']);

        // Simpan binary foto ke database
        if ($request->hasFile('foto')) {
            $data['foto'] = file_get_contents($request->file('foto')->getRealPath());
        }

        $perangkat = PerangkatDesa::create($data);

        // Encode foto agar bisa di-JSON-kan
        $perangkat->foto = base64_encode($perangkat->foto);

        return response()->json($perangkat, 201);
    }


    public function show($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        return response()->json($perangkat);
    }

    public function update(Request $request, $id)
    {
        $perangkat = PerangkatDesa::find($id);
        if (!$perangkat) {
            return response()->json(['message' => 'Perangkat tidak ditemukan'], 404);
        }

        // Validasi data
        $request->validate([
            'nama'    => 'sometimes|string',
            'jabatan' => 'sometimes|string',
            'kontak'  => 'sometimes|string',
            'foto'    => 'sometimes|file|mimes:jpg,jpeg,png'
        ]);

        // Update kolom biasa
        $perangkat->nama    = $request->input('nama', $perangkat->nama);
        $perangkat->jabatan = $request->input('jabatan', $perangkat->jabatan);
        $perangkat->kontak  = $request->input('kontak', $perangkat->kontak);

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            $foto = file_get_contents($request->file('foto')->getRealPath());
            $perangkat->foto = $foto;
        }

        $perangkat->save();

        // Encode foto agar bisa di-JSON-kan
        $perangkat->foto = base64_encode($perangkat->foto);

        return response()->json($perangkat);
    }


    public function destroy($id)
    {
        PerangkatDesa::destroy($id);
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
