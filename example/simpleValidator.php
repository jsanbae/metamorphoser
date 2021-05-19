<?php

use \Jsanbae\Metamorphoser\Dataset;
use \Jsanbae\Metamorphoser\DataError;
use \Jsanbae\Metamorphoser\Validators\AbstractValidator;

class simpleValidator extends AbstractValidator {

    public function validate(Dataset $_dataset):Dataset
    {
        $data = $_dataset->getData();
        $errors = [];
        
        if ($data['date'] < '2020-01-01') {
            $errors[]= new DataError($data, "Date can't be less than 2020.");
        }

        if (in_array($data['department_code'], ['C32', 'G24'])) {
            $errors[]= new DataError($data, "This department does not exist.");
        }

        return new Dataset($_dataset->getData(), $_dataset->isFiltered(), $errors);
    }

}