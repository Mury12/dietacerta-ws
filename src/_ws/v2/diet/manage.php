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

use MMWS\Factory\RequestExceptionFactory;
use MMWS\Abstracts\View;
use MMWS\Controller\DietController;
use MMWS\Handler\SESSION;

class Module extends View
{
    /**
     * Call the create method to create a new user into
     * the database.
     */
    function create(): array
    {
        $hasErrors = keys_match($this->body, ['weight', 'carb', 'prot', 'tfat']);
        if (!$hasErrors) {
            $args = (array_merge($this->body, ['userId' => SESSION::get('user_id')]));
            $controller = new DietController($args);
            // Checks if the generated instance is the right user type
            $result = $controller->save();

            set_http_code(201);
            return $result;
        } else {
            throw RequestExceptionFactory::field($hasErrors);
        }
    }

    /**
     * Call the GET method to GET a single user or a set of users
     */
    function get(): array
    {
        $userId = SESSION::get('user_id');
        $controller = new DietController(array_merge($this->params, ['userId' => $userId]));
        $diet = $controller->get($this->query);
        return $controller->transformResponse($diet);
    }

    function getCurrentStats()
    {
        $userId = SESSION::get('user_id');
        $controller = new DietController(array_merge($this->params, ['userId' => $userId]));
        /**
         * @var MMWS\Model\Diet $diet
         */
        $diet = $controller->get($this->query);
        return $controller->withStats($diet);
    }

    /**
     * Call the update method to update a single user
     * in the database
     */
    function update()
    {
        if (array_key_exists('id', $this->params)) {
            $controller = new DietController($this->body);
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
            $controller = new DietController($this->params);
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
