<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\FareController;

Route::post('/quote', [FareController::class, 'quote']);
Route::get('/metrics', [FareController::class, 'metrics']);

class APIService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://dev.freterapido.com/ecommerce/cotacao_v3/';
        $this->apiKey = config('api_key');
    }

    public function getSomething()
    {
        $response = Http::get($this->baseUrl . '/endpoint', [
            'api_key' => $this->apiKey,
        ]);

        return $response->json();
    }
}

Route::post('/quote', function (Request $request) {
    $request->validate([
        'recipient.address.zipcode' => 'required',
        'volumes' => 'required|array',
    ]);

    $apiService = new APIService();
    $data = $apiService->getSomething();

    return response()->json([
        'carrier' => $data,
    ]);
});

Route::get('/metrics', function (Request $request) {
    // Consultar os retornos gravados no banco de dados e calcular as métricas

    return response()->json([
        // Retornar as métricas calculadas
    ]);
});
