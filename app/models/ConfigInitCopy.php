<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/11/2017
 * Time: 15:58
 */

namespace blog\app;


class Config
{
    protected $host = '';
    protected $dbname = '';
    protected $user = '';
    protected $password = '';

    public function logPdo()
    {
        return [
            'hotsname' => $this->host,
            'dbname' => $this->dbname,
            'user' => $this->user,
            'password' => $this->password
        ];
    }
}