<?php

namespace Jsanbae\Metamorphoser\Contracts;

use Jsanbae\Metamorphoser\Dataset;

interface Handler
{
    public function nextProcess(Handler $_handler): Handler;

    public function handle(Dataset $_dataset): Dataset;
}