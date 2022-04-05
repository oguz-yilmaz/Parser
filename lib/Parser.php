<?php

declare(strict_types=1);

namespace Parser;

use Parser\File;
use Parser\StrategyInterface;

class Parser implements ParserInterface
{
    private File $file;

    private string $mainUrl;

    private StrategyInterface $strategy;

    private array $columns = [];

    private array $results = [];

    public function __construct(File $file, StrategyInterface $strategy) 
    {
        $this->file = $file;
        $this->strategy = $strategy;
    }

    public function setRedirectColumns(array $columns = []): self
    {
        if ($this->checkColumnsArrayLength($columns)) {
            $this->columns = $columns;
        }

        return $this;
    }

    public function setMainUrl(string $url): self
    {
        $this->mainUrl = $url;

        return $this;
    }

    public function getMainUrl(): string
    {
        return $this->mainUrl;
    }

    public function checkColumnsArrayLength($columns): bool
    {
        if (is_array($columns) && !empty($columns) && sizeof($columns) === 2) {
            return true;
        }

        return false;
    }

    public function parse(): self
    {
        $datas = $this->file->getCsvData();

        foreach ($datas as $i => $data) {
            if ($i === 0) {
                continue;
            }

            $paths = $this->getPath($data);

            if ($this->isRedirectedUrlValid($paths[1])) {
                if (!in_array($this->strategy->execute($paths[0], $paths[1]), $this->results)) {
                    $this->results[] = $this->strategy->execute($paths[0], $paths[1], $this->getMainUrl());
                }
            }
        }

        return $this;
    }

    public function getResults(): array
    {
        return $this->results;
    }

    private function isRedirectedUrlValid(string $url): bool
    {
        $r = parse_url($url);

        if ($r !== false) {
            return true;
        }

        return false;
    }

    private function getPath(array $data): array
    {
        $url0 = parse_url($data[$this->columns[0]]);
        $path1 = $url0['path'];

        $url1 = parse_url($data[$this->columns[1]]);
        $path2 = $url1['path'];

        return [$path1, $path2];
    }

    public function __toString(): string
    {
        $resultString = "";

        foreach ($this->results as $result) {
            $resultString .= $result . "<br>";
        }

        return $resultString;
    }
}