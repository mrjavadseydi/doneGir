<?php

namespace App\Lib\Classes\Price;
use App\Lib\Interfaces\TelegramOprator;
class GetPrice extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->message_type=="message"&&$this->text=="💲قیمت امروز💲");
    }

    public function handel()
    {
        sendMessage([
            'chat_id' => $this->chat_id,
            'text'=>getConfig('price_text')
        ]);
    }
}
