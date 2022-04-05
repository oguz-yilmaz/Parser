<?php

declare(strict_types=1);

namespace Parser;

class File 
{
    private array $file;

    public function __construct(string $file = '')
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        if ($file && $ext =='csv') {
            $this->file = file($file);
        }
    }

    public function getCsvData(): array
    {
        $data = [];

        foreach ($this->file as $line) {
            $data[] = str_getcsv($line);
        }

        return $data;
    }
}