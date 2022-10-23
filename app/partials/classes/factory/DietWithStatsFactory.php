<?php

namespace MMWS\Factory;

use MMWS\Interfaces\IFactory;
use MMWS\Model\Diet;
use MMWS\Response\DietResponse;
use MMWS\Response\DietWithStats;

class DietFactory implements IFactory
{
    public static function create(array $data)
    {
        $model = new Diet();
        foreach ($data as $key => $prop) {
            if (property_exists($model, $key)) {
                $model->{$key} = $prop;
            }
        }
        $model->calcCalories();
        return $model;
    }

    /**
     * @var $diet
     * @var MealWithStats[] $meal
     */
    public static function withStatsByObject(Diet $diet, ?array $meals = [], ?bool $withMeals = false)
    {
        $withStats = new DietWithStats(
            $diet->id,
            $diet->userId,
            $diet->weight,
            $diet->createdAt,
            $diet->carb,
            $diet->prot,
            $diet->tfat,
            $diet->cal,
            $diet->act
        );
        $withStats->calcTotalMacros($meals, $withMeals);
        return $withStats;
    }

    public static function dietResponse(Diet $diet)
    {
        return new DietResponse(
            $diet->id,
            $diet->userId,
            $diet->weight,
            $diet->createdAt,
            $diet->carb,
            $diet->prot,
            $diet->tfat,
            $diet->cal,
            $diet->act
        );
    }
}
