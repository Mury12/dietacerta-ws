<?php

namespace MMWS\Traits;

trait Calories
{
    public function calcCalories()
    {
        $this->calories = ceil($this->prot * 4 + $this->carb * 4 + $this->tfat * 9);
    }
}
