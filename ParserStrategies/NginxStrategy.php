<?php

declare(strict_types=1);

namespace Parser;

class NginxStrategy implements StrategyInterface
{
	public function execute(string $pathFrom, string $pathTo, string $mainUrl=""): string
	{
		return "location ~ ^{$pathFrom}$ {
      			return 301 \$scheme://\$server_name{$pathTo};
			}";
	}
}