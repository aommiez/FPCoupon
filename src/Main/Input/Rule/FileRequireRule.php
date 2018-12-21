<?php

namespace Main\Input\Rule;

use Main\Model\SubjectQuery;
use Psr\Http\Message\UploadedFileInterface;

class FileRequireRule extends BaseRule
{
    protected $message = [
        'en'=> 'File not upload'
    ];

    public function __invoke($field, $value, array $params)
    {
        if($value instanceof UploadedFileInterface) {
            return $value->getError() == 0;
        }
        return false;
    }
}
