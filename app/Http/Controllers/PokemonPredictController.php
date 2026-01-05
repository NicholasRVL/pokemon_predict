<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Input;
use GuzzleHttp\Client;

class PokemonPredictController extends Controller {
    public function storeResult(Request $request) {
        $request->validate(['input_id' => 'required|exists:inputs,id']);

        $input = Input::findOrFail($request->input_id);
        $client = new Client();

        try {
            $response = $client->request('POST', env('FLASK_API_URL') . '/predict', [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen(storage_path("app/public/{$input->image}"), 'r'),
                        'filename' => basename($input->image)
                    ]
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            // Simpan ke tabel pokemon_predictions tanpa kolom image
            $prediction = $input->predictions()->create([
                'label'      => $data['prediction'] ?? 'unknown',
                'confidence' => $data['predictions'][0]['confidence'] ?? 0
            ]);

            // Menambahkan data image dari parent agar frontend tetap bisa menampilkan gambar
            $prediction->image = $input->image;

            return response()->json($prediction);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}