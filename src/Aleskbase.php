<?php

namespace YandexMetrikaAlesk\src;

final class Aleskbase extends Database
{
    public function __construct(string $host, string $user, string $password, string $database)
    {
        parent::__construct($host, $user, $password, $database);
    }


    public function getRows($limit = 250, $offset = 0)
    {
        $query = "SELECT * FROM `in_progress` LIMIT $limit OFFSET $offset";
        $request = $this->getRequest($query);

        return $this->getResponse($request);
    }
}