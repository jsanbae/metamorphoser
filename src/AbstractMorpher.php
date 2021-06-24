<?php

namespace Jsanbae\Metamorphoser;

use Jsanbae\Metamorphoser\Pipeline;
use Jsanbae\Metamorphoser\Contracts\MorphProcess;

abstract class AbstractMorpher implements MorphProcess {
    
    /**
     * @var Pipeline
     */    
    private $pipeline;

    /**
     * @var array
     */    
    private $dataTreated = ['data' => [], 'errors' => [], 'filtered' => []];

    /**
     * Set the pipes order for metamorph data
     * 
     * @return Pipeline
     */
    public function setPipeline():Pipeline
    {
        $pipeline = new Pipeline();
        return $pipeline;
    }

    /**
     * Execute pipeline for metamorph data
     * 
     * @param array $_rawData
     * @return array 
     */
    public function morph(array $_rawData):array
    {
        $pipeline = $this->setPipeline();
        
        foreach ($_rawData as $line_index => $data_line) {
            $dataset = new Dataset($data_line);
            
            if ($pipeline->hasPipes()) {
                $datasetProcessed = $pipeline->assembly()[0]->handle($dataset);
                    
                if ($datasetProcessed->isFiltered()) {
                    $this->dataTreated['filtered'][] = $datasetProcessed->getData();
                } else {
                    $this->dataTreated['data'][] = $datasetProcessed->getData();
                }
                if ($datasetProcessed->hasErrors()) {
                    $this->dataTreated['errors'][$line_index] = $datasetProcessed->getErrors();
                }
            } else {
                $this->dataTreated['data'][] = $dataset;
            }
        }
        
        return $this->dataTreated;
    }

    /**
     * Metamorph data from CSV File
     * 
     * @param string $_file_path
     * @param string $_separator 
     * @return array
     */
    public function morphFromCSV(string $_file_path, string $_separator = ';', bool $_removeFirstLine = false):array
    {
        $data = [];

        $file_data = file($_file_path);

        if ($_removeFirstLine) {
            array_shift($file_data);
        }

        foreach ($file_data as $line) {
            $data[] = str_getcsv($line, $_separator, '"');
        }

        return $this->morph($data);
    }
}
