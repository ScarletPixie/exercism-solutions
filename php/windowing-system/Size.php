<?php
declare(strict_types=1);

class Size
{
	public $width;
	public $height;

	public function __construct(int $height, int $width)
	{
		$this->width = $width;
		$this->height = $height;
	}
}