<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatSKDB;

class RiwayatSKDBController extends Controller
{
     // Middleware JWT
    // public function ()
    // {
    //      return response()->json(auth()->user());
    // }

    // GET all
    public function index()
    {
        return response()->json(RiwayatSKDB::all(), 200);
    }

    // POST create
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string',
            'jenis_kelamin'=> 'nullable|string',
            'tempat_lahir'=>'nullable|string',
            'tgl_lahir' => 'nullable|string',
            'agama' => 'nullable|string',
            'status' => 'nullable|string',
            'kewarganegaraan' => 'nullable|string',
            'alamat' => 'required|string',
        ]);

        $data = RiwayatSKDB::create($validated);
        return response()->json($data, 201);
    }

    // GET detail
    public function show($id)
    {
        $data = RiwayatSKDB::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($data);
    }

    // PUT update
    public function update(Request $request, $id)
    {
        $data = RiwayatSKDB::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string',
            'jenis_kelamin'=> 'nullable|string',
            'tempat_lahir'=>'nullable|string',
            'tgl_lahir' => 'nullable|string',
            'agama' => 'nullable|string',
            'status' => 'nullable|string',
            'kewarganegaraan' => 'nullable|string',
            'alamat' => 'required|string',
        ]);

        $data->update($validated);
        return response()->json($data);
    }

    // DELETE
    public function destroy($id)
    {
        $data = RiwayatSKDB::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Data deleted']);
    }
}
