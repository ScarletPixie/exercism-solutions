<?php

class HighSchoolSweetheart
{
	public function firstLetter(string $name): string
	{
		return (trim($name))[0];
	}

	public function initial(string $name): string
	{
		return strtoupper($this->firstLetter($name)) . '.';
	}

	public function initials(string $name): string
	{
		$names = explode(' ', $name);
		$firstNameInitial = "{$this->initial($names[0])}";
		$lastNameInitial = "{$this->initial(end($names))}";

		return "$firstNameInitial $lastNameInitial";
	}

	public function pair(string $sweetheart_a, string $sweetheart_b): string
	{
		$ini1 = $this->initials($sweetheart_a);
		$ini2 = $this->initials($sweetheart_b);

		return <<<EOF
		     ******       ******
		   **      **   **      **
		 **         ** **         **
		**            *            **
		**                         **
		**     $ini1  +  $ini2     **
		 **                       **
		   **                   **
		     **               **
		       **           **
		         **       **
		           **   **
		             ***
		              *
		EOF;
	}
}