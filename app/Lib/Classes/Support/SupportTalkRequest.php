<?php

namespace App\Lib\Classes\Support;

use App\Lib\Interfaces\TelegramOprator as TelegramOprator;

class SupportTalkRequest extends TelegramOprator
{

    public function initCheck()
    {
       return ($this->message_type=="message"&&$this->text=="📨 پشتیبانی 📨");
    }

    public function handel()
    {
       setState($this->chat_id,'send_message_to_support');
       sendMessage([
           'chat_id'=>$this->chat_id,
           'text'=>'لطفا مشکل خود را بیان کنید',
           'reply_markup'=>backButton()
       ]);
    }
}
