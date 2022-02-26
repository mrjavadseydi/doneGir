<?php

namespace App\Lib\Classes\Vip;

use App\Lib\Interfaces\TelegramOprator as TelegramOprator;

class EnterToVip extends TelegramOprator
{

    public function initCheck()
    {
        // TODO: Implement initCheck() method.
    }

    public function handel()
    {
        sendMessage([
            'chat_id'=>$this->chat_id,
            'text'=>"سلام،اگه از کاربران VIP هستید لطفا پسورد خود را وارد کنید.",
            'reply_markup'=>backButton(),
        ]);
        setState($this->chat_id,"vip_password");
    }
}
