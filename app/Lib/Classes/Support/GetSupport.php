<?php
namespace App\Lib\Classes\Support;
use \App\Lib\Interfaces\TelegramOprator;
class GetSupport extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->message_type== 'text' && $this->text == '📃 راهنما 📃');
    }

    public function handel()
    {
        sendMessage([
            'chat_id' => $this->chat_id,
            'text'=>getConfig('support_text'),
        ]);
    }
}
