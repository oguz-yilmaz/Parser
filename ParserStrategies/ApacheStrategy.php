<?php
namespace Parser;

/**
 * Class ApacheStrategy
 * @package Parser
 */
class ApacheStrategy implements StrategyInterface{

	/**
	 * @param $pathFrom
	 * @param $pathTo
	 * @param string $mainUrl
	 *
	 * @return string
	 */
	public function execute( $pathFrom, $pathTo, $mainUrl="" ) {

		return "Redirect 301 $pathFrom $mainUrl$pathTo";

	}

}