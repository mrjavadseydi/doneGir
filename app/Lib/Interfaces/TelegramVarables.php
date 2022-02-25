<?php
namespace App\Lib\Interfaces;
use App\Models\Member;

abstract class TelegramVarables
{
    public $message_type,$data,$text,$chat_id,$from_id, $chat_type,$update;
    public $user = null;

    public function __construct($update)
    {
        $this->message_type = messageType($update);
        $this->updata = $update;
        if ($this->message_type=="callback_query"){
            $this->data = $update["callback_query"]['data'];
            $this->chat_id = $update["callback_query"]['message']['chat']['id'];
            $this->message_id = $update["callback_query"]["message"]['message_id'];
            $this->text = $update["callback_query"]['message']['text'];
            $this->type = $update["callback_query"]['message']['chat']['type'];
        }else{
            $this->text = $update['message']['text'] ?? "//**";
            $this->chat_id = $update['message']['chat']['id'] ?? "";
            $this->from_id = $update['message']['from']['id'] ?? "";
            $this->type = $update['message']['chat']['type'] ?? "";
        }
        $this->user= Member::query()->firstOrCreate(['chat_id'=>$this->from_id],[
            'state'=>null,
            'balance'=>0,
            'first_name'=>$update['message']['from']['first_name']??null,
            'last_name'=>$update['message']['from']['last_name']??null,
            'username'=>$update['message']['from']['username']??null,
            'admin'=>0,
            'block'=>0,
            'vip'=>0,
            'payment'=>1,
            'pay_limit'=>7
        ]);
    }
}
