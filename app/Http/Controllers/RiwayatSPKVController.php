<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatSPKV;

class RiwayatSPKVController extends Controller
{
     // Middleware JWT
    // public function ()
    // {
    //      return response()->json(auth()->user());
    // }

    // GET all
    public function index()
    {
        return response()->json(RiwayatSPKV::all(), 200);
    }

    // POST create
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string',
            'no_kk' => 'nullable|string',
            'tgl_lahir' => 'nullable|string',
            'no_bpjs' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $data = RiwayatSPKV::create($validated);
        return response()->json($data, 201);
    }

    // GET detail
    public function show($id)
    {
        $data = RiwayatSPKV::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($data);
    }

    // PUT update
    public function update(Request $request, $id)
    {
        $data = RiwayatSPKV::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nik' => 'nullable|string|unique:riwayat_SPKV,nik,' . $id,
            'no_kk' => 'nullable|string',
            'tgl_lahir' => 'nullable|string',
            'no_bpjs' => 'sometimes|required|string',
            'alamat' => 'sometimes|required|string',
        ]);

        $data->update($validated);
        return response()->json($data);
    }

    // DELETE
    public function destroy($id)
    {
        $data = RiwayatSPKV::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Data deleted']);
    }
}
