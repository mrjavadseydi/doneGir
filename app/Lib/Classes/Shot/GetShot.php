<?php

namespace App\Lib\Classes\Shot;

use App\Lib\Interfaces\TelegramOprator as TelegramOprator;

class GetShot extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->message_type=="message"&&($this->text=="🖼 ارسال شات 🖼"||$this->text=="🔱 ارسال شات 🔱"));
    }

    public function handel()
    {
        sendMessage([
            'chat_id' => $this->chat_id,
            'text' => 'نوع شات ارسالی را انتخاب کنید',
            'reply_markup' => shotTypeButton(getConfig('analize'))
        ]);
        setState($this->chat_id, 'shot_type');
    }
}
