<?php

namespace Parser;

/**
 * Class Parser
 * @package Parser
 */
class Parser implements ParserInterface
{

	/**
	 * @var \Parser\File
	 */
	private $file;

	/**
	 * @var
	 */
	private $mainUrl;

	/**
	 * @var \Parser\StrategyInterface
	 */
	private $strategy;

	/**
	 * @var array
	 */
	private $columns=[];

	/**
	 * @var array
	 */
	private $results=[];

	/**
	 * Parser constructor.
	 *
	 * @param \Parser\File $file
	 * @param \Parser\StrategyInterface $strategy
	 */
	public function __construct( File $file, StrategyInterface $strategy ) {
		$this->file = $file;
		$this->strategy = $strategy;
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
	 * @param array $columns
	 *
	 * @return $this
	 */
	public function setRedirectColumns($columns=[])
	{
		if($this->checkColumnsArrayLength($columns))
		{
			$this->columns = $columns;
		}
		return $this;
	}

	/**
	 * @param $url
	 */
	public function setMainUrl( $url ) {
		$this->mainUrl = $url;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMainUrl() {
		return $this->mainUrl;
	}

	/**
	 * @param $columns
	 *
	 * @return bool
	 */
	public function checkColumnsArrayLength($columns) {
		if(is_array($columns) && !empty($columns) && sizeof($columns)==2){
			return true;
		}
		return false;
	}

	/**
	 * Call this function after setRedirectColumns()
	 *
	 * @return $this
	 */
	public function parse()
	{
		$datas = $this->file->getCsvData();

		foreach ($datas as $i => $data){
			if($i == 0) continue;

			$paths = $this->getPath($data);

			if($this->isRedirectedUrlValid($paths[1])){
				if(!in_array($this->strategy->execute($paths[0], $paths[1]), $this->results))
				{
					$this->results[] = $this->strategy->execute($paths[0], $paths[1], $this->getMainUrl());
				}
			}
		}

		return $this;
	}

	/**
	 * @param $url
	 *
	 * @return bool
	 */
	public function isRedirectedUrlValid($url) {
		$r = parse_url($url);

		if($r !== false){
			return true;
		}
		return false;
	}

	/**
	 * @param $data
	 *
	 * @return array
	 */
	public function getPath($data) {
		$url0 = parse_url($data[$this->columns[0]]);
		$path1 = $url0['path'];

		$url1 = parse_url($data[$this->columns[1]]);
		$path2 = $url1['path'];

		return [$path1, $path2];
	}

	/**
	 * @return array
	 */
	public function getResults(  ) {
		return $this->results;
	}

}