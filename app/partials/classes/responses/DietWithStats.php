<?php


namespace MMWS\Response;

use MMWS\Controller\MealController;
use MMWS\Model\Diet;
use MMWS\Model\Stats;

class DietWithStats extends Diet
{
    public Stats $total;
    public Stats $available;
    public float $fiber = 70;
    public float $sodium = 2000;
    /**
     * @var MealWithStats[] $meals
     */
    public array $meals;
    public int $items = 0;

    /**
     * Calculate total macros based on the meals
     * @param MealWithStats[] $meals
     */
    function calcTotalMacros(array $meals = [], ?bool $withMeals = false)
    {
        $stats = [
            'carb' => 0,
            'prot' => 0,
            'tfat' => 0,
            'calories' => 0,
            'fiber' => 0,
            'sodium' => 0
        ];

        /**
         * @var MealWithStats $meal 
         */
        foreach ($meals as $meal) {
            foreach ($stats as $key => &$stat) {
                $stat += ceil($meal->stats->macros->{$key} ?? 0);
            }
        }
        $this->total = new Stats(
            $stats['carb'],
            $stats['prot'],
            $stats['tfat'],
            $stats['calories'],
            $stats['fiber'],
            $stats['sodium'],
        );

        $this->available = new Stats(
            ceil($this->carb - $this->total->carb),
            ceil($this->prot - $this->total->prot),
            ceil($this->tfat - $this->total->tfat),
            ceil($this->calories - $this->total->calories),
            ceil(70 - $this->total->fiber),
            ceil(2000 - $this->total->sodium),
        );
        if ($withMeals) {
            $this->meals = $meals;
        }
        $this->items = sizeof($meals);
    }
}
