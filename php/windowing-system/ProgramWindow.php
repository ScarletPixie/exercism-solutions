<?php
declare(strict_types=1);
require_once 'Size.php';
require_once 'Position.php';

class ProgramWindow
{
	public $x;
	public $y;
	public $width;
	public $height;

	function __construct()
	{
		$this->x = 0;
		$this->y = 0;
		$this->width = 800;
		$this->height = 600;
	}

	function resize(Size $size): void
	{
		$this->width = $size->width;
		$this->height = $size->height;
	}

	function move(Position $position): void
	{
		$this->x = $position->x;
		$this->y = $position->y;
	}
}
