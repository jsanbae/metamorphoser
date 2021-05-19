<?php

namespace Jsanbae\Metamorphoser\Contracts;

use Jsanbae\Metamorphoser\Dataset;

interface Filter {
    public function filter(Dataset $_dataset):Dataset;
}