<?php

namespace App\Lib\Classes\Vip;

use App\Lib\Interfaces\TelegramOprator as TelegramOprator;

class VipPassword extends TelegramOprator
{

    public function initCheck()
    {
        // TODO: Implement initCheck() method.
    }

    public function handel()
    {
        $vip = \App\Models\VipPassword::where([['chat_id',$this->chat_id],['passcode'=>$this->text]])->first();
        if ($vip){
            $this->user->update([
                'vip'=>true
            ]);
            sendMessage([
                'chat_id'=>$this->chat_id,
                'text'=>"با موفقیت وارد شدید!",
                'reply_markup'=>mainMenu()
            ]);
            setState($this->chat_id);
        }else{
            sendMessage([
                'chat_id'=>$this->chat_id,
                'text'=>'رمز ورودی غلط میباشد!'
            ]);
            setState($this->chat_id);
        }
    }
}
