<?php

namespace Jsanbae\Metamorphoser\Validators;

use Jsanbae\Metamorphoser\Dataset;
use Jsanbae\Metamorphoser\PipeHandler;
use Jsanbae\Metamorphoser\Contracts\Validator;

abstract class AbstractValidator extends PipeHandler implements Validator {

    protected $validator = null;

    /**
     * validate the data
     * 
     * @param Dataset $_dataset
     * @return Dataset
     */
    public function validate(Dataset $_dataset):Dataset 
    {
        return $_dataset;
    }

    /**
     * Pass the validated data to the next pipe
     * 
     * @param Dataset $_dataset
     * @return Dataset
     */
    public function handle(Dataset $_dataset):Dataset
	{
        if ($this->validator) {
            return parent::handle($this->validator->validate($_dataset));
        } else {
            return parent::handle($this->validate($_dataset));
        }

	}

}