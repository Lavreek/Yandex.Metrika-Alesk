<?php

namespace YandexMetrikaAlesk\src;

use Exception;

class Aleskrow
{
    private string $id;

    private string $email;

    private string $phone;

    private string $order_status;

    private string $create_date_time;

    private array $response;

    private function checkVariable($variable) : string
    {
        if (empty($variable)) {
            throw new Exception("\n Required variable is empty. \n");
        }

        return $variable;
    }

    public function __construct($response)
    {
        foreach ($response as $key => $value) {
            $this->$key = $value ?: "";
        }

        $this->response = $response;
    }

    /**
     * @throws Exception
     */
    public function getId() : string
    {
        return $this->checkVariable($this->id);
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPhone() : string
    {
        return $this->phone;
    }

    /**
     * @throws Exception
     */
    public function getOrderStatus() : string
    {
        return $this->checkVariable($this->order_status);
    }

    /**
     * @throws Exception
     */
    public function getCreateDateTime() : string
    {
        return $this->checkVariable(date("d.m.Y H:i", strtotime($this->create_date_time)));
    }

    public function getResponse() : array
    {
        return $this->response;
    }
}