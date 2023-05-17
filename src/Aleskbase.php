<?php

namespace YandexMetrikaAlesk\src;

final class Aleskbase extends Database
{
    public function __construct(string $host, string $user, string $password, string $database)
    {
        parent::__construct($host, $user, $password, $database);
    }


    public function getRows(int $limit = 1, int $offset = 0, bool $single = false) : array|null
    {
        $query = "SELECT * FROM `in_progress` ORDER BY `id` ASC LIMIT $limit OFFSET $offset";
        $request = $this->getRequest($query);

        if ($limit === 1) {
            $single = true;
        }

        return $this->getResponse($request, $single);
    }
}