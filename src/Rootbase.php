<?php

namespace YandexMetrikaAlesk\src;

final class Rootbase extends Database
{
    public function __construct(string $host, string $user, string $password, string $database)
    {
        parent::__construct($host, $user, $password, $database);
    }

    public function checkAleskRow(Aleskrow $aleskRow) : void
    {
        $query = sprintf("SELECT * FROM `metrika_rows` WHERE `client_uniq_id` = '%s'", $aleskRow->getId());
        $request = $this->getRequest($query);

        if ($request) {
            $response = $this->getResponse($request, true);

            $fileCommander = new FileCommander();

            if ($response) {
                if ($response['order_status'] !== $aleskRow->getOrderStatus()) {
                    $fileCommander->setFilename("need-save" . date("Y-m-d") . ".csv");

                    $response['order_status'] = $aleskRow->getOrderStatus();
                    $this->updateAleskRowsStatus($response['id'], $response['order_status']);

                    $fileCommander->pushData($response);
                }
            } else {
                $fileCommander->setFilename(date("Y-m-d") . ".csv");

                $id = $this->insertAleskRows($aleskRow);

                if ($id) {
                    $response = $this->getResponse(
                        $this->getRequest("SELECT * FROM `metrika_rows` WHERE `id` = $id"), true
                    );

                    $fileCommander->pushData($response);
                }
            }
        }
    }

    private function insertAleskRows(Aleskrow $aleskrow)
    {
        $format =
"INSERT INTO `metrika_rows` (`client_uniq_id`, `emails_md5`, `phones_md5`, `order_status`, `create_date_time`)
 VALUES('%s', '%s', '%s', '%s', '%s');";

        $query = sprintf($format, $aleskrow->getId(), $aleskrow->getEmail(), $aleskrow->getPhone(), $aleskrow->getOrderStatus(), $aleskrow->getCreateDateTime());
        $request = $this->getRequest($query);

        if ($request) {
            return $this->getInsertId();
        }

        return null;
    }

    private function updateAleskRowsStatus(int $id, string $status) : void
    {
        $format = "UPDATE `metrika_rows` SET order_status='%s' WHERE `id` = '$id';";

        $query = sprintf($format, $status);
        $this->getRequest($query);
    }
}