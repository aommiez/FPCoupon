<?php
namespace Main\Xcrud;

class XcrudFactory
{
    public function getInstance()
    {
        return \Xcrud::get_instance();
    }
}
