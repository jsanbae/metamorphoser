<?php

namespace Jsanbae\Metamorphoser\Contracts;

use Jsanbae\Metamorphoser\Dataset;

interface Arranger {

	 public function arrange(Dataset $_dataset):Dataset;
	 
}