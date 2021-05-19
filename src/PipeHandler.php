<?php

namespace Jsanbae\Metamorphoser;

use Jsanbae\Metamorphoser\Dataset;
use Jsanbae\Metamorphoser\Contracts\Handler;

abstract class PipeHandler implements Handler
{
    /**
     * @var Handler
     */
    private $nextHandler;

    /**
     * Set the next handler pipe
     * 
     * @param Handler $_handler
     * @return Handler
     */
    public function nextProcess(Handler $_handler): Handler
    {
        $this->nextHandler = $_handler;
        
        return $_handler;
    }

    /**
     * Pass the data to next handler pipe
     * 
     * @param Dataset $_dataset
     * @return  Dataset
     */
    public function handle(Dataset $_dataset):Dataset
    {
 
        if ($this->nextHandler) {
            return $this->nextHandler->handle($_dataset);
        }
        return $_dataset;
    }
}