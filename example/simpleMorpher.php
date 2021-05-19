<?php 

require('./simpleArranger.php');
require('./simpleMutator.php');
require('./simpleFilter.php');
require('./simpleValidator.php');

use Jsanbae\Metamorphoser\Pipeline;
use Jsanbae\Metamorphoser\AbstractMorpher;

class simpleMorpher extends AbstractMorpher {


    public function setPipeline():Pipeline
    {
        $pipeline = new Pipeline();
        $pipeline->addPipe(new simpleArranger());
        $pipeline->addPipe(new simpleMutator());
        $pipeline->addPipe(new simpleFilter());
        $pipeline->addPipe(new simpleValidator());
 //       var_dump($pipeline->getPipes());
        return $pipeline;
    }

}