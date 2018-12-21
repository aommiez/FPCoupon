<?php

namespace Main\Auth\Storage;

use Main\Model\User;
use Predis\Client;

class RedisStorage implements IStorage
{
    /**
     * [$predis description].
     *
     * @var Client
     */
    private $predis;

    private $hashName = 'auth';

    public function __construct(Client $predis)
    {
        $this->predis = $predis;
    }

    public function store($key, User $user)
    {
        return $this->predis->hset($this->hashName, $key, serialize($user));
    }

    public function search($key)
    {
        $user = $this->predis->hget($this->hashName, $key);
        if ((bool) $user) {
            return unserialize($user);
        }

        return false;
    }

    public function remove($key)
    {
        return $this->predis->hdel($this->hashName, $key);
    }
}
