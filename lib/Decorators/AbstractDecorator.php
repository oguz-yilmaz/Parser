<?php

namespace Parser\Decorators;

use Parser\ParserInterface;

/**
 * Class AbstractDecorator
 * @package Parser\Decorators
 */
abstract class AbstractDecorator implements ParserInterface
{
	/**
	 * @return mixed
	 */
	abstract function parse();
}