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
    
    /**
     * Outputs Collector
     * @var
     */
    private $customOutputs;

    public function __construct(array $_data, bool $_isFiltered = false, array $_errors = [], array $_customOutputs = [])
    {
        $this->data = $_data;
        $this->isFiltered = $_isFiltered;
        $this->errors = $_errors;
        $this->customOutputs = $_customOutputs;
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
    
    public function getCustomOutputs():array
    {
        return $this->customOutputs;
    }
    
    public function hasCustomOutputs():bool
    {
        return (count($this->customOutputs)) ? true : false;
    }

}
