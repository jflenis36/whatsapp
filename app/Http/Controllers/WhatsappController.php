<?php

namespace App\Http\Controllers;

use App\Models\Dominio;
use App\Models\Mesagge;
use App\Models\Users;
use App\Services\WhatsappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class WhatsappController extends Controller
{

    public function sendMessage(Request $request, WhatsappService $whatsapp_service) {
        $data = $request->all();
        extract($data);
        $client = new Client([
            'verify' => storage_path('app/cacert.pem'),
        ]);
        DB::commit();

        //Almacenar en nuestra base de datos los mensajes enviados
        $message_id = $whatsapp_service->saveMesagge($data);

        // dd($mesagge);
        //Enviar mensaje a meta
        $data['to'] = '57'.$data['to'];
        $response = $client->post('https://graph.facebook.com/v19.0/233967206476109/messages', [
            'headers' => [
                'Authorization' => 'Bearer '. env('APP_TOKEN_WHATSAPP_SEND') ,
                'Content-Type' => 'application/json',
            ],
            'json' => $data
        ]);

        $responseJson = $response->getBody()->getContents();
        $responseArray = json_decode($responseJson, true);

        // Itera sobre cada mensaje
        foreach ($responseArray['messages'] as $message) {
            // Accede al estado del mensaje
            $messageStatus = $message['message_status'];
            switch($messageStatus) {
                case 'accepted':
                    $message_status_id = Dominio::where('code', 'sent')->where('group_code', 'message-status')->first()->id;
                    // dd($message_status_id);
                    $message = Mesagge::find($message_id);
                    $message->message_status_id = $message_status_id;
                    $message->save();
                    break;
            }
        }
        DB::rollBack();
        return ["message" => "success", "code" => 200];
    }

}
