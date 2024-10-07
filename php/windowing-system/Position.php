<?php
declare(strict_types=1);

class Position
{
	public $x;
	public $y;

	public function __construct(int $y, int $x)
	{
		$this->x = $x;
		$this->y = $y;
	}
}
