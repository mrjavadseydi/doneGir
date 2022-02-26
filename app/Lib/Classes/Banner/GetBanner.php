<?php
namespace App\Lib\Classes\Banner;
use App\Lib\Interfaces\TelegramOprator;
use App\Models\Banner;

class GetBanner extends TelegramOprator
{

    public function initCheck()
    {
        return ($this->message_type=="message"&&$this->text=="📮 دریافت بنر 📮");
    }

    public function handel()
    {
        $banners = Banner::all();
        foreach ($banners as $banner) {
           if($banner->type=="message"){
               sendMessage([
                   'chat_id'=>$this->chat_id,
                   'text'=>$banner->caption,
               ]);
           }elseif ($banner->type=="photo"){
               sendPhoto([
                   'chat_id'=>$this->chat_id,
                   'photo'=>$banner->file_id,
                   'caption'=>$banner->caption,
               ]);
           }elseif ($banner->type=="video") {
               sendVideo([
                   'chat_id' => $this->chat_id,
                   'video' => $banner->file_id,
                   'caption' => $banner->caption,
               ]);
           }elseif ($banner->type=="document") {
               sendDocument([
                   'chat_id' => $this->chat_id,
                   'audio' => $banner->file_id,
                   'caption' => $banner->caption,
               ]);
           }
        }
    }
}
