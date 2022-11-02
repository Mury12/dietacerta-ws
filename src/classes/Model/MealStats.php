<?php

namespace MMWS\Model;

use MMWS\Abstracts\Model;
use MMWS\Model\Food;

class MealStats extends Model
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
            round($this->food->carb / $weight * $this->amount, 1),
            round($this->food->prot / $weight * $this->amount, 1),
            round($this->food->tfat / $weight * $this->amount, 1),
            ceil($this->food->calories / $weight * $this->amount),
            round($this->food->fiber / $weight * $this->amount, 1),
            round($this->food->sodium / $weight * $this->amount, 1),
        );
    }
}
