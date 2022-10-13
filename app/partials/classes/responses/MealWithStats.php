<?php

namespace MMWS\Response;

use MMWS\Model\Food;
use MMWS\Model\Meal;
use MMWS\Model\Stats;

class MealWithStats extends Meal
{
    public Stats $stats;
    public Food $food;
}
