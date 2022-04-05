<?php

declare(strict_types=1);

namespace Parser;

interface StrategyInterface
{
    public function execute(string $pathFrom, string $pathTo, string $mainUrl = '');
}