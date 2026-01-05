<?php

namespace App\Http\Controllers;

use App\Models\Input;
use Illuminate\Http\Request;

class PredictionController extends Controller
{
    // Simpan input + hasil predict
    public function store(Request $request)
    {
        $input = Input::create([
            'feature_1' => $request->feature_1,
            'feature_2' => $request->feature_2,
            'feature_3' => $request->feature_3,
        ]);

        $input->predictions()->createMany([
            [
                'prediction_result' => 'Class A',
                'confidence' => 0.85
            ],
            [
                'prediction_result' => 'Class B',
                'confidence' => 0.65
            ]
        ]);

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $input->load('predictions')
        ]);
    }

    // Tampilkan semua data
    public function index()
    {
        return Input::with('predictions')->get();
    }

    // Detail berdasarkan ID
    public function show($id)
    {
        return Input::with('predictions')->findOrFail($id);
    }
}
