<?php
namespace Main\Input;
use Symfony\Component\Console\Input\Input;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Request;

/**
 * @package Main\Input\BaseInput
 */
abstract class BaseInput
{
  /**
   * [$req description]
   * @var ServerRequestInterface
   */
  protected $req;

  public function __construct(ServerRequestInterface $req)
  {
    $this->setReq($req);
  }

  public function setReq(ServerRequestInterface $req)
  {
    $this->req = $req;
  }

  public function getReq()
  {
    return $this->req;
  }

  public function validate()
  {
    return true;
  }

  /**
   * [getData description]
   * @return array
   */
  abstract function getData();
}
