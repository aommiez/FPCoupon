<?php

namespace Main\Auth;

use Firebase\JWT\JWT;
use Interop\Container\ContainerInterface;
use Main\Auth\Storage\IStorage;
use Main\Model\User;
use Slim\Http\Request;

class Auth
{
    protected $ci;

    /**
     * [$storage description]
     * @var IStorage
     */
    private $storage;

    /**
     * @var User
     */
    private $user;

    private $secret = 'kafm';

    public function __construct(ContainerInterface $ci, IStorage $storage)
    {
        $this->ci = $ci;
        $this->storage = $storage;
    }

    public function getUser()
    {
        if ($this->user == null) {
            $this->user = $this->storage->search($_COOKIE['web_jwt']);
        }

        return $this->user;
    }

    public function reload()
    {
        if ($this->isAuthorized()) {
            $this->getUser()->reload();
        }
    }

    public function isAuthorized()
    {
        return (bool) $this->getUser();
    }

    public function attempPassword($username, $password)
    {
        $user = User::findByUsername($username);
        if (!$user) {
            // $this->clearSegment();

            return 'USERNAME_NOT_FOUND';
        }
        if ($user->getPassword() != $password) {
            // $this->clearSegment();

            return 'WRONG_PASSWORD';
        }

        $iss = $this->ci->request->getUri()->getAuthority();
        $payload = [
            'iss' => $iss,
            'exp' => time() + (60 * 60),
            'user' => $user->getUsername()
        ];
        $jwt = JWT::encode($payload, $this->secret);
        $this->save($jwt, $user);

        return $jwt;
    }

    public function save($jwt, $user)
    {
        $this->storage->store($jwt, $user);
        $this->user = $user;
        // setcookie("auth-jwt", $jwt);
    }

    public function remove($key)
    {
        $this->storage->remove($key);
    }
}
