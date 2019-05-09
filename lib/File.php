<?php
namespace Parser;

/**
 * Class File
 * @package Parser
 */
class File {
	/**
	 * @var array|bool
	 */
	private $file;

	/**
	 * File constructor.
	 *
	 * @param string $file
	 */
	public function __construct( $file="" )
	{
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		if($file && $ext =="csv"){
			$this->file = file($file);
		}

	}

	/**
	 * @return array
	 */
	public function getCsvData()
	{
		$data = [];

		foreach ($this->file as $line) {
			$data[] = str_getcsv($line);
		}
		return $data;
	}
}