<?php

require "vendor/autoload.php";

$file = new Parser\File("mld.csv");
$parser = new Parser\Parser($file, new Parser\ApacheStrategy());

$parser->setRedirectColumns([0,1])
	   ->setMainUrl("https://www.example.com")
	   ->parse()
	   ->_toString();