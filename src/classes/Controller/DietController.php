<?php

/**
 * This file was automatically generated by the Awesome Conflex API Model Generator Module
 * based in MYSQL/Mariadb database tables. After the generation you can modify
 * this model to fill with the best methods you think it should have.
 * 
 * 
 * Take care of this template and abuse of this.
 * 
 * Thank you for using it. github.com/mury12
 * 
 */

namespace MMWS\Controller;

use MMWS\Abstracts\Controller;
use MMWS\Model\Diet;
use MMWS\Entity\DietEntity;
use MMWS\Factory\DietFactory;
use MMWS\Response\DietWithStats;

class DietController extends Controller
{
    public $entity;
    public $model;

    public function __construct(array $data = [])
    {
        $model = new Diet();
        foreach ($data as $key => $prop) {
            if (property_exists($model, $key)) {
                $model->{$key} = $prop;
            }
        }
        $model->calcCalories();
        $this->entity = new DietEntity($model);
        $this->model = &$this->entity->model;
    }

    function withStats(Diet $diet)
    {
        $ctl = new MealController();
        $meals = $ctl->getAllFromToday();
        $withStats = DietFactory::withStatsByObject($diet, $ctl->withFoodStats($meals));
        return $withStats;
    }

    /**
     * @param MMWS\Model\Diet[]
     */
    function transformResponse(array $diet)
    {
        return array_map(function ($item) {
            return DietFactory::dietResponse($item);
        }, $diet);
    }
}
