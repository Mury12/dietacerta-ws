<?php

/**
 * This is the Manage Module.
 * A Module is a class that extends a a View, performing as 
 * a controller to a certain endpoint. Use this class to
 * perform calls to the actual controllers that execute
 * functions related to this procedures.
 * 
 * Description of this endpoint
 *
 *
 */

use MMWS\Controller\DietController;
use MMWS\Factory\RequestExceptionFactory;
use MMWS\Interfaces\View;
use MMWS\Controller\MealController;
use MMWS\Model\Meal;

class Module extends View
{
    /**
     * Call the create method to create a new user into
     * the database.
     */
    function create(): array
    {
        $hasErrors = keys_match($this->body, ['foodId', 'qtd']);
        if (!$hasErrors) {
            $dietCtl = new DietController();
            $actDietId = $dietCtl->get(['filters' => ['act' => 1]], true);
            if (!sizeof($actDietId)) throw RequestExceptionFactory::create('You have to create a diet first.', 400);

            $controller = new MealController(array_merge($this->body, ['dietId' => $actDietId[0]->id]));
            // Checks if the generated instance is the right user type
            $result = $controller->save();

            set_http_code(201);
            return $result;
        } else {
            throw RequestExceptionFactory::field($hasErrors);
        }
    }

    function bulkCreate()
    {
        $dietCtl = new DietController();
        $actDietId = $dietCtl->get(['filters' => ['act' => 1]], true);
        if (!sizeof($actDietId)) throw RequestExceptionFactory::create('You have to create a diet first.', 400);

        $meals = $this->body;
        if (!is_array($meals))
            throw RequestExceptionFactory::create("Meals must be an array of Meal, received" + gettype($meals) + "instead", 400);

        $hasErrors = [];
        /**
         * @var MMWS\Model\Meal[] $instances
         */
        $instances = [];
        foreach ($meals as $meal) {
            $error = keys_match($meal, ['foodId', 'qtd']);
            if ($error) $hasErrors[] = $error;
            else $instances[] = new Meal(null, $actDietId[0]->id, $meal['foodId'], $meal['qtd']);
        }
        if (sizeof($hasErrors)) throw RequestExceptionFactory::field($hasErrors);
        $controller = new MealController();
        return $controller->bulkCreate($instances);
    }

    /**
     * Call the GET method to GET a single user or a set of users
     */
    function get(): array
    {
        $controller = new MealController($this->params);
        if (array_key_exists('today', $this->query) && boolval($this->query['today']) === true) {
            $meals = $controller->getAllFromToday($this->query);
        } else {
            $meals = $controller->get($this->query);
        }
        return $controller->withFoodStats($meals);
    }

    /**
     * Call the update method to update a single user
     * in the database
     */
    function update()
    {
        if (array_key_exists('id', $this->params)) {
            $controller = new MealController($this->body);
            $controller->model->id = $this->params['id'];
            return $controller->update();
        } else {
            throw RequestExceptionFactory::field(['id']);
        }
    }

    /**
     * Call the delete method to delete a single user in the database.
     */
    function delete()
    {
        if (array_key_exists('id', $this->params)) {
            $controller = new MealController($this->params);
            return $controller->delete();
        } else {
            throw RequestExceptionFactory::field(['id']);
        }
    }
}

/**
 * @var MMWS\Handler\Request contains the request data
 */
global $request;
return new Module($request);
