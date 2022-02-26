<?php

use Telegram\Bot\Objects\Message as MessageObject;

class CustomMethod
{
    use \Telegram\Bot\Traits\Http;

    public  function copyMessage($params){
        $response = $this->post('copyMessage', $params);

        return new MessageObject($response->getDecodedBody());
    }
}
