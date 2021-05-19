<?php

namespace Jsanbae\Metamorphoser\Contracts;

use Jsanbae\Metamorphoser\Dataset;

interface Validator {
    public function validate(Dataset $_dataset):Dataset;
}