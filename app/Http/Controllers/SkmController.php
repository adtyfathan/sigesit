<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Skm;

class SkmController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'skorLayanan' => [
                'required',
                'string',
                Rule::in(['kurang', 'cukup', 'puas', 'sangat puas']),
            ],
            'skorFasilitas' => 'required|numeric|min:1|max:10',
            'skorPetugas' => 'required|numeric|min:1|max:10',
            'skorAksesibilitas' => 'required|numeric|min:1|max:10',
            'komentar' => 'nullable|string',
        ]);

        // Optional: Check user & duplicate submission
        // $user = Auth::user();
        // if (!$user || $user->role_id != 1) {
        //     return response()->json(['message' => 'Unauthorized.'], 403);
        // }

        $transaksi = Transaksi::find($validated['transaksi_id']);
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi not found.'], 404);
        }

        // $isSubmitted = Skm::where('transaksi_id', $transaksi->id)
        //     ->where('user_id', $user->id)
        //     ->exists();

        // if ($isSubmitted) {
        //     return response()->json(['message' => 'Survey already submitted.'], 403);
        // }

        $totalSkor = ($validated['skorFasilitas'] + $validated['skorPetugas'] + $validated['skorAksesibilitas']) / 3;

        $skm = Skm::create([
            'total_skor' => $totalSkor,
            'skor_layanan' => $validated['skorLayanan'],
            'skor_fasilitas' => $validated['skorFasilitas'],
            'skor_petugas' => $validated['skorPetugas'],
            'skor_aksesibilitas' => $validated['skorAksesibilitas'],
            'komentar' => $validated['komentar'],
            'user_id' => 2,
            'transaksi_id' => $transaksi->id,
            'tanggal_survey' => now(),
        ]);

        return response()->json([
            'message' => 'Survey berhasil disimpan.',
            'data' => $skm
        ], 201);
    }
}