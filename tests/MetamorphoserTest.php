<?php
require('example/simpleArranger.php');
require('example/simpleMutator.php');
require('example/simpleFilter.php');
require('example/simpleValidator.php');

use PHPUnit\Framework\TestCase;
use Jsanbae\Metamorphoser\Dataset;
use Jsanbae\Metamorphoser\DataError;

class MetamorphoserTest extends Testcase {

    /*
     * Testing an Arranger
     */
    public function testCanArrangeData()
    {
        $data = ['01-01-2020','al','A01','shoes','12','1.000.000,00'];
        $arranger = new simpleArranger();
        $dataset = new Dataset($data);

        $expected_data = new Dataset([
            'date' => '01-01-2020',
            'state' => 'al',
            'department_code' => 'A01',
            'product' =>'shoes',
            'quantity' =>'12',
            'value' =>'1.000.000,00'
        ]);

        $this->assertEquals($arranger->arrange($dataset), $expected_data);
    }

    /*
     * Testing a Mutator
     */
    public function testCanMutateData()
    {
        $data = ['date' => '01-01-2020','state' => 'al','department_code' => 'A01','product' =>'shoes','quantity' =>'12','value' =>'1000000,00'];
        $mutator = new simpleMutator();
        $dataset = new Dataset($data);

        $expected_data = new Dataset([
            'date' => '2020-01-01',
            'state' => 'AL',
            'department_code' => 'A01',
            'product' => 'Shoes',
            'quantity' => '12',
            'value' => '1000000'
        ]);

        $this->assertEquals($mutator->mute($dataset), $expected_data);
    }

    /*
     * Testing a Validator
     */
    public function testCanValidateDataWithDateGreaterThan2020()
    {
        $data = ['date' => '2019-01-01', 'state' => 'AL', 'department_code' => 'A01', 'product' => 'Shoes', 'quantity' => '12', 'value' => '1000000'];
        $validator = new simpleValidator();
        $dataset = new Dataset($data);

        $expected_data = [new DataError($data, "Date can't be less than 2020.")];

        $data_validated = $validator->validate($dataset);

        $this->assertEquals($data_validated->getErrors(), $expected_data);
    }

    /*
     * Testing a Filter
     */
    public function testCanFilterDataWithValueZero()
    {
        $data = ['date' => '2019-01-01', 'state' => 'AL', 'department_code' => 'A01', 'product' => 'Shoes', 'quantity' => '12', 'value' => '0'];
        $filter = new simpleFilter();
        $dataset = new Dataset($data);

        $data_filtered = $filter->filter($dataset);

        $this->assertEquals($data_filtered->isFiltered(), true);
    }
}
