<?php

namespace Jsanbae\Metamorphoser;


class DataError {

    private $data;
    private $message;

    public function __construct(array $_data, string $_message) {
        $this->data = $_data;
        $this->message = $_message;
    }

    public function getData():array
    {
        return $this->data;
    }

    public function getMessage():string
    {
        return $this->message;
    }
} 