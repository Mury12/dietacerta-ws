<?php

namespace MMWS\Model;

use MMWS\Interfaces\AbstractModel;
use MMWS\Model\Food;

class MealStats extends AbstractModel
{
    protected Stats $macros;
    protected float $amount;

    protected Food $food;

    public function __construct(Food $food, float $amount)
    {
        $this->food = $food;
        $this->amount = $amount;
        $this->calcStats();
        $this->setHiddenFields(['food']);
    }

    private function calcStats()
    {
        $weight = $this->food->weight ?? 1;
        $this->macros = new Stats(
            $this->food->carb / $weight * $this->amount,
            $this->food->prot / $weight * $this->amount,
            $this->food->tfat / $weight * $this->amount,
            $this->food->cal / $weight * $this->amount,
            $this->food->fiber / $weight * $this->amount,
            $this->food->sodium / $weight * $this->amount,
        );
    }
}
