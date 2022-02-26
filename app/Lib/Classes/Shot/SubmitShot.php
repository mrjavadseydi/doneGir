<?php

namespace App\Lib\Classes\Shot;

use App\Lib\Interfaces\TelegramOprator as TelegramOprator;
use App\Models\Shot;
use Illuminate\Support\Facades\Cache;

class SubmitShot extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->user->state=="send_shot");

    }

    public function handel()
    {
        if (isset($this->update['message']['media_group_id'])) {
            sendMessage([
                'chat_id' => $this->chat_id,
                'text' => "لطفا شات ها را به صورت تکی ارسال کنید",
                'reply_markup' => shotBackButton()

            ]);
            return false;
        }
        $type = Cache::pull('shot_type_' . $this->chat_id);
        Shot::create([
            'vip' => $this->user->vip,
            'chat_id' => $this->chat_id,
            'type' => $type,
            'status' => 0,
            'file_id' => $this->update['message']['video']['file_id'],
        ]);
        sendMessage([
            'chat_id' => $this->chat_id,
            'text' => str("شات شما با موفقیت دریافت شد")
                ->append("\n تعداد شات های شما ")
                ->append(Shot::where([['chat_id', $this->chat_id], ['status', 0]])->count())
                ->append("\n")
                ->append('در صورت ارسال تمام شات ها دکمه اتمام و ارسال راانتخاب کنید'),
            'reply_markup' => shotBackButton()
        ]);


    }
}
