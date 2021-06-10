<?php

namespace Jsanbae\Metamorphoser\Arrangers;

use Jsanbae\Metamorphoser\Dataset;
use Jsanbae\Metamorphoser\PipeHandler;
use Jsanbae\Metamorphoser\Contracts\Arranger;

abstract class AbstractArranger extends PipeHandler implements Arranger {

    protected $arranger = null;

    /**
     * Arrange the data
     * 
     * @param Dataset $_dataset
     * @return Dataset
     */
    public function arrange(Dataset $_dataset):Dataset 
    {
        return $_dataset;
    }

    /**
     * Pass the arrange data to the next pipe
     * 
     * @param Dataset $_dataset
     * @return Dataset
     */
    public function handle(Dataset $_dataset):Dataset
	{
        if ($this->arranger) {
            return parent::handle($this->arranger->arrange($_dataset));
        } else {
            return parent::handle($this->arrange($_dataset));
        }
	}

}