<?php

namespace App\Http\Controllers;

use App\Models\UserPlan;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function createPreapprovalPlan()
    {
        $client = new Client();

        try {
            // Obtener el ID del usuario autenticado
            $userId = auth()->id();

            // Construir el back_url con el ID del usuario
            $backUrl = "https://www.agendasoftware.online/mercadopago/callback?user_id={$userId}";

            // Crear el plan de suscripción con el back_url modificado
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
                    'back_url' => $backUrl,
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

    public function updatePreapprovalPlan($id)
    {
        $client = new Client();
        $planId = $id;
        // $planId = '2c938084910f95b601913422f7650b5e'; 

        try {
            // Define el token de acceso y la URL de la API de Mercado Pago
            $accessToken = env('MERCADO_PAGO_ACCESS_TOKEN');
            $url = "https://api.mercadopago.com/preapproval/{$planId}";

            // Define los datos que deseas actualizar
            $data = [
                "auto_recurring" => [
                    "transaction_amount" => 6999, // Nuevo monto de la transacción
                    "currency_id" => "ARS"
                ],
                "reason" => "Agenda Software - Suscripcion Premium",
                "status" => "cancelled", // Estado del plan
                "back_url" => "https://www.agendasoftware.online" // Nueva URL de retorno
            ];

            // Realiza la solicitud PUT para actualizar el plan de suscripción
            $response = $client->put($url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => $data
            ]);

            // Decodifica la respuesta
            $data = json_decode($response->getBody(), true);

            // Retorna la respuesta en formato JSON
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

    public function handleCallback(Request $request)
    {
        $userId = $request->input('user_id'); // Obtener el ID del usuario desde la URL
        $status = $request->input('status'); 
        $subscriptionId = $request->input('id'); 

        if ($status == 'authorized'){
            $userPlan = UserPlan::where('idUser', $userId)->first();
            if($subscriptionId == '2c938084910f959d01913eb368e00ee9'){
                $userPlan->idPlan = 1;
                $userPlan->vencimiento = null;
                $userPlan->save();
            } elseif($subscriptionId == '2c938084910f95b901913eb546f20ee9'){
                $userPlan->idPlan = 2;
                $userPlan->vencimiento = null;
                $userPlan->save();
            }
            return redirect()->route('suscripcion')->with('message', '¡Suscripción completada exitosamente!');
        }

        // Redirigir al usuario a una página de confirmación o al dashboard
        return redirect()->route('suscripcion');
    }
}
