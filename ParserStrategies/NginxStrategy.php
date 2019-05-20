<?php

namespace Parser;

/**
 * Class NginxStrategy
 * @package Parser
 */
class NginxStrategy implements StrategyInterface
{

	/**
	 * @param $pathFrom
	 * @param $pathTo
	 * @param string $mainUrl
	 *
	 * @return string
	 */
	public function execute( $pathFrom, $pathTo, $mainUrl=""  ) {

		return " location ~ ^{$pathFrom}$ {
      			return 301 \$scheme://\$server_name{$pathTo};
			}";

	}

}