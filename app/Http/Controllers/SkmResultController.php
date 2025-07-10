<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkmResult; // Penting: Import model SkmResult Anda

class SkmResultController extends Controller
{
    /**
     * Menyimpan data survei yang dikirimkan.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        // Ini sangat penting untuk keamanan dan integritas data
        $validatedData = $request->validate([
            'ikm_score'      => 'required|integer|min:0|max:100', // Sesuai range database dummy Anda
            'service_aspect' => 'required|string|max:255', // Dropdown, jadi harus ada
            'comment'        => 'nullable|string|max:500', // Opsional, maks 500 karakter
        ]);

        // 2. Simpan Data ke Database
        SkmResult::create([
            'ikm_score'      => $validatedData['ikm_score'],
            'comment'        => $validatedData['comment'],
            'service_aspect' => $validatedData['service_aspect'],
            // 'survey_date' akan otomatis diisi oleh database (dari useCurrent() di migration)
            // 'created_at' dan 'updated_at' otomatis dari timestamps()
        ]);

        // 3. Beri feedback ke pengguna (redirect dengan pesan sukses)
        return redirect()->back()->with('success', 'Terima kasih atas masukan Anda! Survei berhasil dikirim.');
    }
}