<?php declare(strict_types=1);

class PizzaPi
{
    //  unit:   grams;
    private const MIN_DOUGH_REQ = 200;
    private const DOUGH_PER_PERSON = 20;
    private const PER_PIZZA_SAUCE_ML = 125;
    private const PER_PIZZA_SLICES = 8;

    public function calculateDoughRequirement(int $pizza_num, int $people_num): int
    {
        return $pizza_num * (($people_num * $this::DOUGH_PER_PERSON) + $this::MIN_DOUGH_REQ);
    }

    public function calculateSauceRequirement(int $pizza_num, int $can_volume_ml): float
    {
        return $pizza_num * $this::PER_PIZZA_SAUCE_ML / $can_volume_ml;
    }

    public function calculateCheeseCubeCoverage(int|float $cheese_side_len, int|float $cheese_thickness, int|float $pizza_diameter): int
    {
        $totalVolume = $cheese_side_len ** 3;
        return (int)($totalVolume / ($cheese_thickness * pi() * $pizza_diameter));
    }

    public function calculateLeftOverSlices(int $pizza_num, int $people_num): int
    {
        $totalSlices = $pizza_num * $this::PER_PIZZA_SLICES;
        return $totalSlices % $people_num;
    }
}
