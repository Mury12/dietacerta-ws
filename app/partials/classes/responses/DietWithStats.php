<?php


namespace MMWS\Response;

use MMWS\Controller\MealController;
use MMWS\Model\Diet;
use MMWS\Model\Stats;

class DietWithStats extends Diet
{
    public Stats $total;
    public Stats $available;
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
            'fibers' => 0,
            'sodium' => 0
        ];

        /**
         * @var MealWithStats $meal 
         */
        foreach ($meals as $meal) {
            foreach ($stats as $key => &$stat) {
                $stat += $meal->stats->macros->{$key} ?? 0;
            }
        }
        $this->total = new Stats(
            $stats['carb'],
            $stats['prot'],
            $stats['tfat'],
            $stats['calories'],
            $stats['sodium'],
            $stats['fibers'],
        );

        $this->available = new Stats(
            $this->carb - $this->total->carb,
            $this->prot - $this->total->prot,
            $this->tfat - $this->total->tfat,
            $this->calories - $this->total->calories,
            $this->total->fibers,
            $this->total->sodium,
        );
        if ($withMeals) {
            $this->meals = $meals;
        }
        $this->items = sizeof($meals);
    }
}
