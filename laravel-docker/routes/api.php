<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\FareController;

Route::post('/quote', [FareController::class, 'quote']);
Route::get('/metrics', [FareController::class, 'metrics']);
Route::post('/quote', function (Request $request) {
    $data = $request->validate([
        'recipient.address.zipcode' => 'required',
        'volumes' => 'required|array',
    ]);

    class APIService
    {
        protected $baseUrl;
        protected $apiKey;
    
        public function __construct()
        {
            $this->baseUrl = 'https://dev.freterapido.com/ecommerce/cotacao_v3/';
            $this->apiKey = config('1d52a9b6b78cf07b08586152459a5c90'); 
        }
    
        public function getSomething()
        {
            $response = Http::get($this->baseUrl . '/endpoint', [
                'api_key' => $this->apiKey,
            ]);
    
            return $response->json();
        }
    }
    
    return response()->json([
        'carrier' => [
            [
                'name' => 'Frete Raápido',
                'service' => 'Entregas',
                'deadline' => '3',
                'price' => 17,
            ],
            [
                'name' => 'Correios',
                'service' => 'SEDEX',
                'deadline' => 1,
                'price' => 20.99,
            ],
        ],
    ]);
});

Route::get('/metrics', function (Request $request) {
    $lastQuotes = $request->query('last_quotes');

    // Consultar os retornos gravados no banco de dados e calcular as métricas

    return response()->json([
        // Retornar as métricas calculadas
    ]);
});
