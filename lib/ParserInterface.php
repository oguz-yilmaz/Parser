<?php

declare(strict_types=1);

namespace Parser;

interface ParserInterface
{
	public function parse(): self;

	public function setRedirectColumns(array $columns): self;

	public function setMainUrl(string $url): self;
}