<?php

namespace Jsanbae\Metamorphoser\Filters;

use Jsanbae\Metamorphoser\Dataset;
use Jsanbae\Metamorphoser\PipeHandler;
use Jsanbae\Metamorphoser\Contracts\Filter;

abstract class AbstractFilter extends PipeHandler implements Filter {

    protected $filter = null;

    /**
     * Filter the data
     * 
     * @param Dataset $_dataset
     * @return Dataset
     */
    public function filter(Dataset $_dataset):Dataset 
    {
        return $_dataset;
    }

    /**
     * Pass the filtered data to the next pipe
     * 
     * @param Dataset $_dataset
     * @return Dataset
     */
    public function handle(Dataset $_dataset):Dataset
	{
		if ($this->filter) {
            return parent::handle($this->filter->filter($_dataset));
        } else {
            return parent::handle($this->filter($_dataset));
        }
	}

}