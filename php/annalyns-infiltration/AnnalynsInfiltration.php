<?php

class AnnalynsInfiltration
{
    public function canFastAttack($is_knight_awake)
    {
        if ($is_knight_awake === false)
        {
            return true;
        }
        return false;
    }

    public function canSpy($is_knight_awake, $is_archer_awake, $is_prisoner_awake)
    {
        if ($is_knight_awake === true || $is_archer_awake === true || $is_prisoner_awake === true)
        {
            return true;
        }
        return false;
    }

    public function canSignal($is_archer_awake, $is_prisoner_awake)
    {
        if ($is_archer_awake === false && $is_prisoner_awake === true)
        {
            return true;
        }
        return false;
    }

    public function canLiberate($is_knight_awake, $is_archer_awake, $is_prisoner_awake, $is_dog_present)
    {
        if ($is_archer_awake === true)
            return false;
        if ($is_dog_present === true)
            return true;
        return $is_prisoner_awake === true && $is_knight_awake === false;
    }
}
