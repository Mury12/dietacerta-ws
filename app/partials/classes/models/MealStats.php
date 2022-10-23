<?php

namespace MMWS\Model;

use MMWS\Interfaces\AbstractModel;
use MMWS\Model\Food;

class MealStats extends AbstractModel
{
    public Stats $macros;
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
            ceil($this->food->carb / $weight * $this->amount),
            ceil($this->food->prot / $weight * $this->amount),
            ceil($this->food->tfat / $weight * $this->amount),
            ceil($this->food->calories / $weight * $this->amount),
            ceil($this->food->fiber / $weight * $this->amount),
            ceil($this->food->sodium / $weight * $this->amount),
        );
    }
}
