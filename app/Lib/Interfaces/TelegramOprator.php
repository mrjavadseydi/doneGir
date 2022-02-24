<?php

namespace App\Lib\Interfaces;
abstract class TelegramOprator extends TelegramVarables
{
    public $user, $update,$class_status;

    public function __construct($update)
    {
        parent::__construct($update);
        if ($this->initCheck()) {
            $this->handel();
            $this->class_status =  true;

        }
    }
    abstract public function initCheck();

    abstract public function handel();

}
