<?php

namespace Jsanbae\Metamorphoser\Mutators;

use \Waavi\Sanitizer\Sanitizer;

use Jsanbae\Metamorphoser\Dataset;
use Jsanbae\Metamorphoser\PipeHandler;
use Jsanbae\Metamorphoser\Contracts\Mutator;

abstract class AbstractMutator extends PipeHandler implements Mutator {

    /**
     * Mutate the data
     * 
     * @param Dataset $_dataset
     * @return Dataset
     */
    public function mute(Dataset $_dataset):Dataset
    {
        $data = $_dataset->getData();

        $sanitizer  = new Sanitizer($data, $this->setFilters(), $this->setCustomFilters());
        $data_sanitized = $sanitizer->sanitize();

        return new Dataset($data_sanitized);
    }

    /**
     * Pass the mutated data to the next pipe
     * 
     * @param Dataset $_dataset
     * @return Dataset
     */
    public function handle(Dataset $_dataset):Dataset
	{
		return parent::handle($this->mute($_dataset));
	}

    /**
     * Set the sanitizer's filters
     * 
     * @return array
     */
    protected function setFilters():array
    {
        return [];
    }
    
    /**
     * Set the custom sanitizer's filters
     * 
     * @return array
     */
    protected function setCustomFilters():array
    {
        return [];
    }

    /**
     * Remove element from Dataset
     * 
     * @param array $_dataset
     * @param array $_elementkey
     * @return array
     */
    protected function removeElements(array $_dataset, array $_elementkeys):array
    {
        $data = $_dataset;
        foreach ($_elementkeys as $key) {
            unset($data[$key]);
        }

        return $data;
    }

}