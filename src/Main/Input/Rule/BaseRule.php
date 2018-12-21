<?php
namespace Main\Input\Rule;
use Main\Input\Rule\ValidateMessage\Message;

abstract class BaseRule
{
    protected $message = [
      'en'=> '{field} Invalid'
    ];
    abstract function __invoke($field, $value, array $params);

    public function getMessage()
    {
        $lang = 'en';
        if(isset($this->message[$lang])){
            return $this->message[$lang];
        }
        return '';
    }
}
