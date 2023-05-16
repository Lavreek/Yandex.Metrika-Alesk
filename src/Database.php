<?php

namespace YandexMetrikaAlesk\src;

use mysqli;
use mysqli_result;

class Database
{
    private mysqli $mysqli;

    public function __construct(string $host, string $user, string $password, string $database)
    {
        $this->mysqli = new mysqli($host, $user, $password, $database);
    }

    protected function getResponse($request, bool $single = false)
    {
        if (mysqli_num_rows($request) > 0) {
            if ($single) {
                return mysqli_fetch_array($request, MYSQLI_ASSOC);
            }

            return mysqli_fetch_all($request, MYSQLI_ASSOC);
        }

        return null;
    }

    protected function getRequest($query) : mysqli_result|bool
    {
        return $this->mysqli->query($query);
    }

    protected function getInsertId() : int|string
    {
        return mysqli_insert_id($this->mysqli);
    }
}