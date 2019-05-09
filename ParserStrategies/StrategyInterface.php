<?php

namespace Parser;

/**
 * Interface StrategyInterface
 * @package Parser
 */
interface StrategyInterface {

	/**
	 * @param $pathFrom
	 * @param $pathTo
	 * @param string $mainUrl
	 *
	 * @return mixed
	 */
	public function execute($pathFrom, $pathTo, $mainUrl="");

}