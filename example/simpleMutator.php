<?php

use \Jsanbae\Metamorphoser\Mutators\AbstractMutator;

class simpleMutator extends AbstractMutator {

    protected function setFilters():array
    {
        $filters = [
            'date'            => 'trim|format_date:d-m-Y, Y-m-d',
            'state'           => 'trim|uppercase',
            'product'         => 'trim|escape|capitalize',
            'quantity'        => 'trim|cast:float',
            'value'           => 'trim|cast:float',
        ];

        return $filters;
    }
}