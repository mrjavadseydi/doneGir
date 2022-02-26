<?php

namespace App\Lib\Classes\Done;

use App\Lib\Interfaces\TelegramOprator;

class GetDone extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->message_type=="message"&&($this->text=="🔱 ثبت دان 🔱"||$this->text=='✔️ ثبت دان ✔️'));
    }

    public function handel()
    {
       sendMessage([
           'chat_id'=>$this->chat_id,
           'text'=>'🔹 لطفا فقط لینک پیج یا پیج های خود را با ویو حدودی در قالب یک پیام ارسال کنید ',
           'reply_markup'=>backButton()
       ]);
       setState($this->chat_id,'send_done');
    }
}
