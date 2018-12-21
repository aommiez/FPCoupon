<?php
namespace Main\Auth\Storage;
use Main\Model\User;

interface IStorage
{
    /**
     * [store description]
     * @param  string $key  [description]
     * @param  User $user [description]
     * @return boolean       [description]
     */
    public function store($key, User $user);

    /**
     * [search description]
     * @param  string $key  [description]
     * @return User       [description]
     */
    public function search($key);

    /**
     * [remove description]
     * @param  [type] $key [description]
     * @return boolean      [description]
     */
    public function remove($key);
}
