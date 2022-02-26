<?php
namespace App\Lib\Classes;
use App\Lib\Interfaces\TelegramOprator;
use App\Models\Shot;

class Start extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->message_type=="message"&&($this->text=="/start"||$this->text=="بازگشت ↪️"||$this->text=="حذف شات و بازگشت"));
    }

    public function handel()
    {
        if($this->text=="حذف شات و بازگشت"){
            Shot::where([['chat_id',$this->chat_id],['status',0]])->delete();
        }
        sendMessage([
            'chat_id' => $this->chat_id,
            'text'=>'با لمس کردن دکمه چهارخانه، کیبورد داخلی باز خواهد شد و شما به راحتی به قسمت های مختلف ربات دسترسی خواهید داشت.',
            'reply_markup'=>mainMenu($this->user->vip)
        ]);
        setState($this->chat_id);
    }
}
