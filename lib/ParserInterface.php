<?php

namespace Parser;

/**
 * Interface ParserInterface
 * @package Parser
 */
interface ParserInterface
{
	/**
	 * @return mixed
	 */
	public function parse();

	/**
	 * @param $columns
	 *
	 * @return mixed
	 */
	public function setRedirectColumns($columns);

	/**
	 * @param $url
	 *
	 * @return mixed
	 */
	public function setMainUrl($url);
}