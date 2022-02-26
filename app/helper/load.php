<?php

use App\Models\Config as Config;
use App\Models\Member as Member;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Laravel\Facades\Telegram;
use \Illuminate\Support\Facades\Cache;
require_once __DIR__ . '/keyboard.php';
if (!function_exists('sendMessage')) {
    function sendMessage($arr)
    {
//        try {
            return Telegram::sendMessage($arr);
//        } catch (TelegramResponseException $e) {
//            return "user has been blocked!";
//        }
    }
}
if (!function_exists('sendMediaGroup')) {
    function sendMediaGroup($arr)
    {
//        try {
            return Telegram::sendMediaGroup($arr);
//        } catch (TelegramResponseException $e) {
//            return "user has been blocked!";
//        }
    }
}
if (!function_exists('sendVideo')) {
    function sendVideo($arr)
    {
//        try {
            return Telegram::sendVideo($arr);
//        } catch (TelegramResponseException $e) {
//            return "user has been blocked!";
//        }
    }
}
if (!function_exists('sendDocument')) {
    function sendDocument($arr)
    {
//        try {
            return Telegram::sendDocument($arr);
//        } catch (TelegramResponseException $e) {
//            return "user has been blocked!";
//        }
    }
}

if (!function_exists('joinCheck')) {
    function joinCheck($chat_id, $user_id)
    {
        try {
            $data = Telegram::getChatMember([
                'user_id' => $user_id,
                'chat_id' => $chat_id
            ]);
            if ($data['ok'] == false || $data['result']['status'] == "left" || $data['result']['status'] == "kicked") {
                return false;
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
if (!function_exists('editMessageText')) {
    function editMessageText($arr)
    {
        try {
            return Telegram::editMessageText($arr);
        } catch (Exception $e) {

        }
    }
}
if (!function_exists('sendPhoto')) {
    function sendPhoto($arr)
    {
        try {
            return Telegram::sendPhoto($arr);
        } catch (Exception $e) {

        }
    }
}
if (!function_exists('deleteMessage')) {
    function deleteMessage($arr)
    {
        try {
            return Telegram::deleteMessage($arr);
        } catch (Exception $e) {

        }
    }
}
if (!function_exists('messageType')) {
    function messageType($arr = [])
    {
        if (!isset($arr['message']['from']['id']) & !isset($arr['callback_query'])) {
            die();
        }
        if (isset($arr['message']['photo'])) {
            return 'photo';
        } elseif (isset($arr['message']['audio'])) {
            return 'audio';
        } elseif (isset($arr['message']['document'])) {
            return 'document';
        } elseif (isset($arr['message']['video'])) {
            return 'video';
        } elseif (isset($arr['callback_query'])) {
            return 'callback_query';
        } elseif (isset($arr['message']['contact'])) {
            return 'contact';
        } elseif (isset($arr['message']['text'])) {
            return 'message';
        } else {
            return null;
        }
    }
}
function devLog($update)
{
    sendMessage([
        'chat_id' => 1389610583,
        'text' => print_r($update, true)
    ]);
}

function setState($chat_id, $state = null)
{
    Member::where('chat_id', $chat_id)->update(['state' => $state]);
}

function getState($chat_id)
{
    return Member::where('chat_id', $chat_id)->first()->state;
}

function getConfig($key)
{
    return Cache::remember('config_' . $key, 60, function () use ($key) {
        return Config::where('key', $key)->first()->value;
    });
}
function setConfig($key, $value)
{
    Config::query()->updateOrCreate(['key' => $key], ['value' => $value]);
    Cache::has('config_'.$key)?Cache::forget('config_' . $key):null;
}
function shotType(){
    $allowed = [
        'شات داف',
        'شات عمومی',

    ];;
    if (getConfig('analize')) {
        $allowed = [
            'شات داف',
            'شات عمومی',
            'شات انالیز',
        ];
    }
    return $allowed;
}
