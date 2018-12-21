<?php

namespace Main\Input\Exception;

class ValidateException extends \Exception
{
    protected $fields;
    public function getFields()
    {
        return $this->fields;
    }
    public function setFields($fields)
    {
        $this->fields = $fields;
    }
}
