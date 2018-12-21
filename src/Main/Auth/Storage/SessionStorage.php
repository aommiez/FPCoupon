<?php

namespace Main\Auth\Storage;

use Main\Model\User;
use Predis\Client;

class SessionStorage implements IStorage
{
    private $hashName = 'auth';

    public function __construct()
    {
        // if (session_status() == PHP_SESSION_NONE) {
        //     session_start();
        // }
    }

    public function store($key, User $user)
    {
        $_SESSION['auth'] = [];
        $_SESSION[$this->hashName][$key] = serialize($user);
    }

    public function search($key)
    {
        $user = $_SESSION[$this->hashName][$key];
        if ((bool) $user) {
            return unserialize($user);
        }

        return false;
    }

    public function remove($key)
    {
        $_SESSION['auth'] = [];
        return true;
    }
}
