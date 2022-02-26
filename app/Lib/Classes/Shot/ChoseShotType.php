<?php

namespace App\Lib\Classes\Shot;

use App\Lib\Interfaces\TelegramOprator as TelegramOprator;
use Illuminate\Support\Facades\Cache;

class ChoseShotType extends TelegramOprator
{

    public function initCheck()
    {
        // TODO: Implement initCheck() method.
    }

    public function handel()
    {
       $allowed = shotType();
        if (!in_array($this->text, $allowed)) {
            sendMessage([
                'chat_id' => $this->chat_id,
                'text' => 'نوع شات صحیح نیست',
                'reply_markup' => shotTypeButton(getConfig('analize'))
            ]);
            return true;
        }
        Cache::put('shot_type_'.$this->chat_id,$this->text);
        sendMessage([
            'chat_id' => $this->chat_id,
            'text' => 'شات های خود را ارسال کنید 🖼
و در آخر دکمه اتمام و ارسال شات را بزنید
#قوانین شات
شات حتما از صفحه اصلی پیج شروع بشه_امار استوری کاملا مشخص باشه✅',
            'reply_markup' => shotBackButton()
        ]);
        setState($this->chat_id, 'send_shot');
    }
}
