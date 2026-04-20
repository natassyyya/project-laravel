<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getData()
    {
        if (!Storage::disk('local')->exists('mahasiswa.json')) {
            return response()->json([
                'message' => 'File mahasiswa.json tidak ditemukan.'
            ], 404);
        }

        $json = Storage::disk('local')->get('mahasiswa.json');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'message' => 'Format JSON tidak valid.'
            ], 500);
        }

        return response()->json($data);
    }
}
