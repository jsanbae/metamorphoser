<?php

namespace Jsanbae\Metamorphoser\Contracts;

use Jsanbae\Metamorphoser\Dataset;

interface Mutator {

	public function mute(Dataset $_dataset):Dataset;
	 
}