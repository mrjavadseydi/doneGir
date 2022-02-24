<?php
namespace App\Lib\Interfaces;
abstract class TelegramVarables
{
    public $message_type,$data,$text,$chat_id,$from_id;
    public $user = null;

    public function __construct($update)
    {
        $this->message_type = messageType($update);
        if ($this->message_type=="callback_query"){
            $this->data = $update["callback_query"]['data'];
            $this->chat_id = $update["callback_query"]['message']['chat']['id'];
            $this->message_id = $update["callback_query"]["message"]['message_id'];
            $this->text = $update["callback_query"]['message']['text'];
        }else{
            $this->text = $update['message']['text'] ?? "//**";
            $this->chat_id = $update['message']['chat']['id'] ?? "";
            $this->from_id = $update['message']['from']['id'] ?? "";
        }

    }
}
