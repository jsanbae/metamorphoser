<?php

namespace Jsanbae\Metamorphoser\Contracts;

use Jsanbae\Metamorphoser\Pipeline;

interface MorphProcess {

    public function morph(array $data):array;
    public function setPipeline():Pipeline;

}