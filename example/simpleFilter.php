<?php

use \Jsanbae\Metamorphoser\Dataset;
use \Jsanbae\Metamorphoser\Filters\AbstractFilter;

class simpleFilter extends AbstractFilter {

    public function filter(Dataset $_dataset):Dataset
    {
        $data = $_dataset->getData();
        $filtered = false;
        
        if ($data['value'] == 0) {
            $filtered = true;
        }

        if ($data['state'] == 'CA') {
            $filtered = true;
        }

        return new Dataset($data, $filtered);
    }

}