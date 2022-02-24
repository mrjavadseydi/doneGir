<?php
namespace App\Lib\Classes;
use App\Lib\Interfaces\TelegramOprator;

class Start extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->message_type=="message"&&$this->text=="/start");
    }

    public function handel()
    {
        sendMessage([
            'chat_id' => $this->chat_id,
            'text'=>'start!'
        ]);
    }
}
