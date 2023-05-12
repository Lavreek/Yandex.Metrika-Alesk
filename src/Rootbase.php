<?php

namespace YandexMetrikaAlesk\src;

final class Rootbase extends Database
{
    public function __construct(string $host, string $user, string $password, string $database)
    {
        parent::__construct($host, $user, $password, $database);
    }
}