<?php

namespace Main\Input\Rule;

use Main\Model\SubjectQuery;
use Psr\Http\Message\UploadedFileInterface;

class FileExtensionRule extends BaseRule
{
    protected $message = [
        'en'=> 'File extension not allow'
    ];

    public function __invoke($field, $value, array $params)
    {
        if($value instanceof UploadedFileInterface) {
            $ext = array_pop(explode('.', $value->getClientFilename()));
            $allow = is_array($params[0])? $params[0]: [$params[0]];
            return in_array($ext, $allow);
        }
        return false;
    }
}
