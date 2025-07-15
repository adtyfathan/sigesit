<?php

namespace App\Http\Controllers;

use App\Models\SkmResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Ensure this is imported
use Carbon\Carbon; // Ensure this is imported

class SkmResultController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ikm_score' => 'required|integer|min:0|max:100',
            'service_aspect' => 'required|string|max:255',
            'comment' => 'nullable|string|max:1000',
        ], [
            'ikm_score.required' => 'Kolom nilai kepuasan harus diisi.',
            'ikm_score.integer' => 'Nilai kepuasan harus berupa angka.',
            'ikm_score.min' => 'Nilai kepuasan minimal adalah 0.',
            'ikm_score.max' => 'Nilai kepuasan maksimal adalah 100.',
            'service_aspect.required' => 'Mohon pilih kategori layanan.',
            'comment.max' => 'Komentar tidak boleh lebih dari 1000 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SkmResult::create([
            'ikm_score' => $request->ikm_score,
            'service_aspect' => $request->service_aspect,
            'comment' => $request->comment,
            'survey_date' => Carbon::now()->toDateString(), // Set current date as survey date
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Survei kepuasan Anda berhasil disimpan. Masukan Anda sangat berarti bagi kami untuk terus meningkatkan kualitas pelayanan.');
    }
}