<?php
namespace Main\Controller;
use Interop\Container\ContainerInterface;

abstract class BaseAction
{
    protected $ci;
    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }
}
