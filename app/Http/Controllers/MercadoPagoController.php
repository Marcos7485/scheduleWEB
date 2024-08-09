<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function createPreapprovalPlan()
    {
        
        $client = new Client();

        try {
            $response = $client->post('https://api.mercadopago.com/preapproval_plan', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('MERCADO_PAGO_ACCESS_TOKEN'),
                ],
                'json' => [
                    'auto_recurring' => [
                        'frequency' => 1,
                        'frequency_type' => 'months',
                        'billing_day' => 10,
                        'billing_day_proportional' => false,
                        'transaction_amount' => 9999,
                        'currency_id' => 'ARS'
                    ],
                    'back_url' => 'https://www.agendasoftware.online',
                    'payment_methods_allowed' => [
                        'payment_types' => [
                            ['id' => 'credit_card']
                        ],
                        'payment_methods' => [
                            ['id' => 'bolbradesco']
                        ]
                    ],
                    'reason' => 'Agenda Software - Suscripcion Premium'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            return response()->json($data);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return response()->json(json_decode($responseBodyAsString, true), $response->getStatusCode());
            } else {
                return response()->json(['error' => 'Error al conectar con Mercado Pago'], 500);
            }
        }
    }
}
