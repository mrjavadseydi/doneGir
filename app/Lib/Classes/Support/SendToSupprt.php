<?php

namespace App\Lib\Classes\Support;

use App\Lib\Interfaces\TelegramOprator as TelegramOprator;
use App\Models\Support;

class SendToSupprt extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->user->state=="send_message_to_support");
    }

    public function handel()
    {
        $res = copyMessage([
            'chat_id' => getConfig('suport_group'),
            'from_chat_id' => $this->chat_id,
            'message_id' => $this->update['message']['message_id']
        ]);
        Support::create([
            'chat_id' => $this->chat_id,
            'message_id' => $res['result']['message_id'],
            'group_id' => getConfig('suport_group')
        ]);
        sendMessage([
            'chat_id' => $this->chat_id,
            'text' => "پیام شما ارسال شد ، اگر پیام شما ادامه دارد ان را ارسال کنید در غیر این صورت بازگشت را انتخاب کنید و تا زمان دریافت پاسخ از پشتیبانی صبر کنید !",
            'reply_markup' => backButton()
        ]);
    }
}
