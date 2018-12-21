<?php
namespace Main\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class XcrudAjaxAction extends BaseAction
{
    public function __invoke(Request $req, Response $res)
    {
        // $xcrud; //Xcrud::get_instance();
        echo \Xcrud::get_requested_instance();
        // return $res->write();
    }
}
