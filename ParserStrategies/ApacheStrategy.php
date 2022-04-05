<?php

declare(strict_types=1);

namespace Parser;

class ApacheStrategy implements StrategyInterface
{
    public function execute(string $pathFrom, string $pathTo, string $mainUrl = ""): string
    {
        $parsedPathFrom = $this->removeQueryString($pathFrom);
        $pathFrom = $this->replaceSpaceCharsInUrl(parsedPathFrom);

        $parsedPathTo = $this->removeQueryString($pathTo);

        return "Redirect 301 $pathFrom $mainUrl$parsedPathTo";
    }

    private function replaceSpaceCharsInUrl(string $pathFrom): string
    {
        if (preg_match("/%20/", $pathFrom)) {
            $pathFrom = preg_replace('/%20/', ' ', $pathFrom);
            $pathFrom = '"'.$pathFrom.'"';
        }

        return $pathFrom;
    }


    private function removeQueryString(string $path): string
    {
        return preg_replace('/\?.*/', '', $path);
    }

}