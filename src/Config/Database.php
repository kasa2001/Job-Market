<?php


namespace App\Config;


class Database
{
    public function getDns()
    {
        return "pgsql:host=127.0.0.1;dbname=job_market";
    }

    public function getUser()
    {
        return "postgres";
    }

    public function getPassword()
    {
        return "admin";
    }
}