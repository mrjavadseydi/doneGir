<?php

namespace App\Lib\Classes\Shot;

use App\Lib\Interfaces\TelegramOprator as TelegramOprator;
use App\Models\Shot;

class SendShot extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->message_type=="message"||$this->text=="'اتمام و ارسال");
    }

    public function handel()
    {
        $shots = Shot::where([['chat_id', $this->chat_id], ['status', 0]])->get();
        $caption = str('شات های ارسالی از ')
            ->append("[$this->chat_id](tg://user?id=$this->chat_id)")
            ->append("\n {$this->user->first_name} {$this->user->last_name}")
            ->append("\n {$this->user->username}")
            ->append("\n")
            ->append("نوع شات:")
            ->append($shots[0]['type']);
        if (count($shots) == 1) {
            $res = sendVideo([
                'chat_id' => getConfig('group' . str($shots[0]['type'])->slug()),
                'video' => $shots[0]['file_id'],
                'caption' => $caption,
                'parse_mode' => "Markdown"
            ]);
        } else {
            $media = [];
            foreach ($shots as $i => $shot) {
                if ($i == 0) {
                    $media[] = [
                        'type' => 'video',
                        'media' => $shot['file_id'],
                        'parse_mode' => "Markdown",
                        'caption' => $caption,
                    ];
                } else {
                    $media[] = [
                        'type' => 'video',
                        'media' => $shot['file_id'],
                    ];
                }
            }
            $group = $this->user->vip ? getConfig('shot_group_vip') : getConfig('shot_group');
            $res = sendMediaGroup([
                'chat_id' => $group,
                'media' => $media
            ]);
        }
        $message_id = $res['result']['media_group_id'] ?? $res['result']['message_id'];

        $shots->update([
            'message_id' => $message_id,
            'status' => 1,
            'group_id' => $group
        ]);
        sendMessage([
            'chat_id' => $this->chat_id,
            'text' => "شات شما ارسال شد ✅
کمتر از 24ساعت مبلغ به کیف پول شما واریز می شود 💰",
            'reply_markup' => mainMenu()
        ]);
        setState($this->chat_id);


    }
}
