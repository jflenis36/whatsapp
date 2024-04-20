<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\Dominio;
use App\Models\Mesagge;
use App\Models\Users;

class WhatsappService
{
    public function saveMesagge($data)
    {
        $user = Users::where('phone', $data['to'])->first();
        $chat = Chat::where('user_id', $user->id)->first();

        //Si existe el chat, vamos al true, de lo contrario se crea el chat
        if($chat == null) {
            $chat = Chat::create([
                'user_id' => $user->id,
                'last_connection_time' => null,
                'expiration_status' => false,
                'name_by_whatsapp' => null
            ]);
            $chat->save();
        }

        $type_message_id = Dominio::where('code', $data['type'])->first()->id;


        $message = Mesagge::create([
            'chat_id' => $chat->id,
            'message_from_ziro' => true,
            'message_text' => null,
            'type_message_id' => $type_message_id,
            'message_status_id' => null,
            'writing_state' => false
        ]);
        $message->save();

        return $message->id;


    }
}
