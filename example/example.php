<?php

require('../vendor/autoload.php');
require('./simpleMorpher.php');

$file_path = './dataset.csv';

$morpher = new simpleMorpher();
$final_data = $morpher->morphFromCSV($file_path,';',true);
var_dump($final_data);