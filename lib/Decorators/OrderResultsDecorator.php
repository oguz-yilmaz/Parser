<?php

declare(strict_types=1);

namespace Parser\Decorators;

use Parser\ParserInterface;

class OrderResultsDecorator extends AbstractDecorator
{
    private ParserInterface $parser;

    private array $results;

    public function __construct(ParserInterface $parser) 
    {
        $this->parser = $parser;
    }

    public function setRedirectColumns(array $columns): self
    {
        $this->parser->setRedirectColumns($columns);

        return $this;
    }

    public function setMainUrl(string $url)
    {
        $this->parser->setMainUrl($url);
    }

    public function parse(): array
    {
        $this->parser->parse();

        $this->results = $this->parser->getResults();

        return $this->orderResults();
    }

    private function orderResults(): array
    {
        $sizedArray = $this->assignStringSizeToItems();

        krsort($sizedArray);

        return $this->results = $sizedArray;
    }

    public function assignStringSizeToItems(): array
    {
        $newSizeAssignedArray = [];

        foreach ($this->results as $result) {
            $redirectPart = $this->getFirtsPartOfRedirectString($result);
            $newSizeAssignedArray[strlen($redirectPart)] = $result;
        }

        return $newSizeAssignedArray;
    }

    private function getFirtsPartOfRedirectString(string $path): string
    {
        $string = explode(' ', $path);
        array_pop($string);

        $string = implode(' ', $string);

        return $string;
    }

    public function __toString(): string
    {
        $resultString = '';

        foreach ($this->results as $result) {
            $resultString .= $result . '<br>';
        }

        return $resultString;
    }
}