<?php

namespace Parser\Decorators;

use Parser\ParserInterface;

/**
 * Class OrderResultsDecorator
 * @package Parser\Decorators
 */
class OrderResultsDecorator extends AbstractDecorator
{

	/**
	 * @var ParserInterface
	 */
	private $parser;

	/**
	 * @var
	 */
	private $results;

	/**
	 * OrderResultsDecorator constructor.
	 *
	 * @param ParserInterface $parser
	 */
	public function __construct(ParserInterface $parser  ) {
		$this->parser = $parser;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		$resultString = "";
		foreach ($this->results as $result){
			$resultString .= $result."<br>";
		}
		return $resultString;
	}

	/**
	 * @param $columns
	 */
	public function setRedirectColumns( $columns )
	{
		$this->parser->setRedirectColumns($columns);
	}

	/**
	 * @param $url
	 */
	public function setMainUrl( $url )
	{
		$this->parser->setMainUrl($url);
	}

	/**
	 * @return array
	 */
	public function parse() {
		$this->parser->parse();
		$this->results = $this->parser->getResults();
		return $this->orderResults();
	}

	/**
	 * @return array
	 */
	private function orderResults()
	{
		$sizedArray = $this->assignStringSizeToItems();
		krsort($sizedArray);
		$this->results = $sizedArray;
		return $sizedArray;
	}

	/**
	 * @return array
	 */
	public function assignStringSizeToItems()
	{
		$newSizeAssignedArray = [];
		foreach ( $this->results as $result ) {
			$redirectPart = $this->getFirtsPartOfRedirectString($result);
			$newSizeAssignedArray[strlen($redirectPart)] = $result;
		}
		return $newSizeAssignedArray;
	}

	/**
	 * @param $path
	 *
	 * @return array|string
	 */
	private function getFirtsPartOfRedirectString($path)
	{
		$string = explode(' ', $path);
		array_pop($string);
		$string = implode(' ', $string);
		return $string;
	}


}