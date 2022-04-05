<?php

declare(strict_types=1);

namespace Parser\Decorators;

use Parser\ParserInterface;

abstract class AbstractDecorator implements ParserInterface
{
    abstract function parse();
}