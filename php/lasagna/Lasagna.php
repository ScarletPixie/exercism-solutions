<?php

class Lasagna
{
    //  unit: minutes;
    private const COOK_TIME = 40;
    private const LAYER_COOK_TIME = 2;

    public function expectedCookTime()
    {
       return $this::COOK_TIME;
    }

    public function remainingCookTime($elapsed_minutes)
    {
        return $this::COOK_TIME - $elapsed_minutes;
    }

    public function totalPreparationTime($layers_to_prep)
    {
        return $layers_to_prep * $this::LAYER_COOK_TIME;
    }

    public function totalElapsedTime($layers_to_prep, $elapsed_minutes)
    {
        $totalTime = $this->totalPreparationTime($layers_to_prep);
        return $totalTime + $elapsed_minutes;
    }

    public function alarm()
    {
        return 'Ding!';
    }
}
