<?php 

namespace Jsanbae\Metamorphoser;

use Jsanbae\Metamorphoser\PipeHandler;

class Pipeline {

    private $pipes;

    public function __construct()
    {
        $this->pipes = [];
        $this->checkPipes();
    }

    public function getPipes():array
    {
        return $this->pipes;
    }

    public function addPipe(PipeHandler $_pipe)
    {
        $this->pipes[] = $_pipe;
    }

    public function hasPipes():bool
    {
        return (count($this->getPipes())) ? true : false;
    }

    public function assembly():array
    {
        $pipes = $this->pipes;
        
        $totalPipes = count($pipes);

        for ($i=0; $i < $totalPipes; $i++) {
            $currentPipe = $pipes[$i];
            
            if (array_key_exists($i+1, $pipes)) {
                $nextPipe = $pipes[$i+1];
                $currentPipe->nextProcess($nextPipe);
            }
        }

        return $this->pipes;
    }

    /**
     * Checks that pipes be PipeHanlder
     * 
     * @return void|Exception
     */
    private function checkPipes():void 
    {
        if (count($this->pipes)) {
            foreach ($this->pipes as $index => $pipe) {
                if (!$pipe instanceof PipeHandler) {
                    throw new \Exception("All pipeline's elements must be PipeHandler", 1);
                }
            }
        }
    }

}