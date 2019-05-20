<?php

namespace Parser;

/**
 * Class ApacheStrategy
 * @package Parser
 */
class ApacheStrategy implements StrategyInterface
{

	/**
	 * @param $pathFrom
	 * @param $pathTo
	 * @param string $mainUrl
	 *
	 * @return string
	 */
	public function execute( $pathFrom, $pathTo, $mainUrl="" ) {

		$pathFrom = $this->replaceSpaceCharsInUrl($this->removeQueryString($pathFrom));
		$pathTo = $this->removeQueryString($pathTo);

		return "Redirect 301 $pathFrom $mainUrl$pathTo";

	}

	/**
	 * @param $pathFrom
	 *
	 * @return mixed|string
	 */
	private function replaceSpaceCharsInUrl($pathFrom)
	{
		if(preg_match("/%20/", $pathFrom)){
			$pathFrom = preg_replace('/%20/', ' ', $pathFrom);
			$pathFrom = '"'.$pathFrom.'"';
		}

		return $pathFrom;
	}

	/**
	 * @param $path
	 *
	 * @return mixed
	 */
	private function removeQueryString( $path ) {
		return preg_replace('/\?.*/', '', $path);
	}

}