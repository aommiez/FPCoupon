<?php
namespace Main\Input\Rule\ValidateMessage;

class Message implements \JsonSerializable
{
    protected $string = '';
    public function setMesasge($string)
    {
        $this->string = $string;
    }

    public function getMessage()
    {
        return $this->string;
    }

    public function __toString()
    {
        return $this->getMessage();
    }

    public function jsonSerialize()
    {
        return $this->getMessage();
    }
}
