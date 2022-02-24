<?php
namespace App\Lib\Interfaces;
abstract class TelegramOprator extends TelegramVarables
{
    public $user,$update;
    public function __construct($update)
    {
        parent::__construct($update);
    }

}
