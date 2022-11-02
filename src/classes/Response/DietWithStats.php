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
                $stat += $meal->stats->macros->{$key} ?? 0;
            }
        }
        $this->total = new Stats(
            round($stats['carb'], 1),
            round($stats['prot'], 1),
            round($stats['tfat'], 1),
            floor($stats['calories']),
            round($stats['fiber'], 1),
            round($stats['sodium'], 1),
        );

        $this->available = new Stats(
            round($this->carb - $this->total->carb, 1),
            round($this->prot - $this->total->prot, 1),
            round($this->tfat - $this->total->tfat, 1),
            floor($this->calories - $this->total->calories),
            round(70 - $this->total->fiber, 1),
            round(2000 - $this->total->sodium, 1),
        );
        if ($withMeals) {
            $this->meals = $meals;
        }
        $this->items = sizeof($meals);
    }
}
