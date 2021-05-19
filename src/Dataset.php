<?php

namespace Jsanbae\Metamorphoser;

class Dataset {

    /**
     * Data
     * @var
     */
    private $data;

    /**
     * Define if data will be filtered
     * @var
     */
    private $isFiltered;

    /**
     * Errors Collector
     * @var
     */
    private $errors;

    public function __construct(array $_data, bool $_isFiltered = false, array $_errors = [])
    {
        $this->data = $_data;
        $this->isFiltered = $_isFiltered;
        $this->errors = $_errors;
    }

    public function getData():array
    {
        return $this->data;
    }
    
    public function getErrors():array
    {
        return $this->errors;
    }
    
    public function hasErrors():bool
    {
        return (count($this->errors)) ? true : false;
    }

    public function isFiltered():bool
    {
        return $this->isFiltered;
    }

}