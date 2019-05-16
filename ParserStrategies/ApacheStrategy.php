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

		if(preg_match("/%20/", $pathFrom)){
			$newPathFrom = preg_replace('/%20/', ' ', $pathFrom);
			$newPathFrom = '"'.$newPathFrom.'"';
			$pathFrom = $newPathFrom;
		}

		return "Redirect 301 $pathFrom $mainUrl$pathTo";

	}

}