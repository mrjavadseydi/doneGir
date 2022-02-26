<?php

namespace App\Lib\Classes\Done;
use \App\Lib\Interfaces\TelegramOprator;
use App\Models\Done;

class SubmitDone extends TelegramOprator
{

    public function initCheck()
    {
        if($this->user->state=="send_done"){
            if($this->message_type!="message"){
                sendMessage([
                    'chat_id'=>$this->chat_id,
                    'text'=>'فقط متن قابل قبول است'
                ]);
                return false;
            }
            return true;
        }
        return false;
    }

    public function handel()
    {
        if ($this->user->vip){
            $res  = sendMessage([
                'chat_id'=>getConfig('vip_done'),
                'text'=>"دان های ارسالی از {$this->chat_id} \n {$this->text}"
            ]);
        }else{
            $res = sendMessage([
                'chat_id'=>getConfig('done'),
                'text'=>"دان های ارسالی از {$this->chat_id} \n {$this->text}"
            ]);
        }
        Done::create([
            'chat_id'=>$this->chat_id,
            'group_id'=>$this->user->vip ? getConfig('vip_done') : getConfig('done'),
            'vip'=>$this->user->vip,
           'message_id'=>$res['result']['message_id']
        ]);
        sendMessage([
            'chat_id'=>$this->chat_id,
            'text'=>'دان های شما ثبت شد !',
            'reply_markup'=>mainMenu()
        ]);
    }
}
