<?php

require "vendor/autoload.php";

use Parser\Parser;
use Parser\File;
use Parser\ApacheStrategy;
use Parser\Decorators\OrderResultsDecorator;

$file = new File("mld.csv");
$parser = new OrderResultsDecorator(new Parser($file, new ApacheStrategy()));

$parser->setRedirectColumns([0,1]);
$parser->setMainUrl("https://www.example.com");
$parser->parse();

echo $parser;