<?php

namespace MMWS\Response;

use MMWS\Model\Food;
use MMWS\Model\Meal;
use MMWS\Model\MealStats;

class MealWithStats extends Meal
{
    public MealStats $stats;
    public Food $food;
}
