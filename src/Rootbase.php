<?php

namespace YandexMetrikaAlesk\src;

final class Rootbase extends Database
{
    public function __construct(string $host, string $user, string $password, string $database)
    {
        parent::__construct($host, $user, $password, $database);

    }

    public function checkAleskRow(Aleskrow $aleskrow)
    {
        $query = sprintf("SELECT `id` FROM `metrika_rows` WHERE `client_uniq_id` = '%s'", $aleskrow->getId());
        $request = $this->getRequest($query);
        if ($request) {
            $response = $this->getResponse($request);

            if ($response) {

            } else {
                $fileCommander = new FileCommander();

                $filename = date("Y-m-d");
                $fileCommander->makeFile($filename);


            }
        }

    }

    public function insertAleskRows(Aleskrow $aleskrow)
    {

    }
}