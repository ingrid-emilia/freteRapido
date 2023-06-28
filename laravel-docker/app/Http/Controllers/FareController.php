<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Price;

class FareController extends Controller

{
    public function quote(Request $request)
    {
        // Validação dos dados

        $request->validate([
            'recipient.address.zipcode' => 'required',
            'volumes' => 'required|array',
        ]);

        // Montagem da requisição para a API da Frete Rápido
        
        $payload = [
            'shipper' => [
                'registered_number' => '00000000000000',
            ],
            'dispatchers' => [
                'registered_number' => '00000000000000',
            ],
            'recipient' => $request->input('recipient'),
            'volumes' => $request->input('volumes'),
        
            'ship_from' => [
            'address' => [
                'zip_code' => '29161376',
            ],
            ],
        ];

        $response = Http::post('https://dev.freterapido.com/ecommerce/cotacao_v3/', $payload);

        $data = $response->json();

        foreach ($data['carrier'] as $carrier) {
            Price::create([
                'carrier_name' => $carrier['name'],
                'service' => $carrier['service'],
                'deadline' => $carrier['deadline'],
                'price' => $carrier['price'],
            ]);
        }

        return response()->json($data);
    }

    public function metrics(Request $request)
    {
        // Consultar as métricas no banco de dados
        $metrics = [
            'quantity_by_carrier' => Price::select('carrier_name', \DB::raw('count(*) as quantity'))->groupBy('carrier_name')->get(),
            'total_price_by_carrier' => Price::select('carrier_name', \DB::raw('sum(price) as total_price'))->groupBy('carrier_name')->get(),
            'average_price_by_carrier' => Price::select('carrier_name', \DB::raw('avg(price) as average_price'))->groupBy('carrier_name')->get(),
            'cheapest_price' => Price::orderBy('price')->first(),
            'expensive_price' => Price::orderByDesc('price')->first(),
        ];

        return response()->json($metrics);
    }

}  
