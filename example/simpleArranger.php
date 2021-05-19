<?php

use \Jsanbae\Metamorphoser\Dataset;
use \Jsanbae\Metamorphoser\Arrangers\AbstractArranger;

class simpleArranger extends AbstractArranger {

    public function arrange(Dataset $_dataset):Dataset
    {
        $arrange = [];
        
        list(
            $arrange['date'],
            $arrange['state'],
            $arrange['department_code'],
            $arrange['product'],
            $arrange['quantity'],
            $arrange['value']
        ) =  $_dataset->getData();

        return new Dataset($arrange);
    }

}