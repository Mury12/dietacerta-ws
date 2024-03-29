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

namespace MMWS\Entity;

use MMWS\Model\Diet;
use MMWS\Controller\DietController;
use MMWS\Abstracts\Entity;
use MMWS\Handler\PDOQueryBuilder;
use MMWS\Factory\RequestExceptionFactory;
use MMWS\Handler\CaseHandler;
use MMWS\Handler\SESSION;
use PDOException;

class DietEntity extends Entity
{
    /**
     * @var String $table the table name for this model;
     */
    public $table = 'diet';

    public $model;

    public function __construct(Diet $model)
    {
        $this->model = $model;
    }

    /**
     * Saves this instance to the database
     */
    public function save(): array
    {
        try {
            $fields = $this->model->toArray();
            /**
             * Checks if an instance with the same data already exists.
             * Change this $fields to the wanted keys.
             */
            $instanceExists = $this->get(['filters' => $fields], false);

            if (!sizeof($instanceExists)) {
                $stmt = new PDOQueryBuilder($this->table);
                $stmt->insert($fields);

                // stmt->run returns last insert id.
                $id = $stmt->run();

                $stmt->update(['act' => 0])
                    ->where('id', $id['id'], '<')
                    ->and('user_id', SESSION::get('user_id'));
                $stmt->run();
                return ['id' => $id['id']];
            } else {
                throw RequestExceptionFactory::create("Data already exists", 409);
            }
        } catch (PDOException $e) {
            throw RequestExceptionFactory::create("Something bad happened while performing this action", 500);
        }
    }

    /**
     * Updates this instance to the database
     */
    public function update()
    {
        /**
         * @var Diet $hasDiet;
         */
        $hasDiet = $this->getOne(['*'], true);
        if ($hasDiet) {
            $fields = $this->model->toArray();
            $stmt = new PDOQueryBuilder($this->table);
            $stmt->update($fields);
            $stmt->where('id', $this->model->id);

            $stmt->run();
            return [];
        } else {
            throw RequestExceptionFactory::create("Request doesn't contains a valid id", 422);
        }
    }

    /**
     * Get one or a set of instances of the database.
     * @param array $filters the filters to apply. If it is single, filters will be
     * seen as return fields.
     * @param bool $asobj if true, will return an object instead of array.
     * 
     * @return array|Diet
     */
    public function get(array $filters = [], bool $asobj = false, string $aggregator = 'AND')
    {
        if ($this->model->id) {
            return $this->getOne($filters, $asobj);
        } else {
            return $this->getAll($filters, $asobj, $aggregator === 'AND');
        }
    }

    /**
     * Get one instance from the database and returns 
     * as a SELF::CLASS
     * @param array $fields fields to return.
     * @param array $asobj returns as YooUser Object
     * 
     * @return array|Diet
     */
    private function getOne(array $fields = [], bool $asobj = false)
    {
        $columns = sizeof($fields) ? $fields : $this->model->getColumnNames();
        try {
            $stmt = new PDOQueryBuilder($this->table, 1);
            $stmt->select($columns);
            $stmt->where('id', $this->model->id);

            $instance = $stmt->run();
            if (sizeof($instance))
                return $asobj
                    ? (new DietController(
                        CaseHandler::convert($instance[0], 0)
                    ))->model
                    : $instance[0];
            else throw RequestExceptionFactory::create('Object not found', 422);
        } catch (\PDOException $e) {
            throw RequestExceptionFactory::create('Something bad happened while performing this action', 500);
        }
    }

    /**
     * Get all the instances from the database and returns 
     * as a SELF::CLASS array or a pure indexed array
     * @param array $fields fields to return.
     * @param array $asobj returns as Diet Object
     * @param bool $and sets if the filter sould be put with AND or OR

     * @return array|Array<Diet>
     */
    public function getAll(array $filters = [], bool $asobj = false, bool $and = true)
    {
        $fields  = $filters['fields'] ?? [];
        $columns = sizeof($fields) ? $fields : $this->model->getColumnNames();
        try {
            $rowLimit = $filters['amount'] ?? 100;
            $page = $filters['page'] ?? null;

            $stmt = new PDOQueryBuilder($this->table, $rowLimit, $page);

            $stmt->select($columns);
            if (isset($filters['filters']) && sizeof($filters['filters'])) {
                $stmt->setFilters($filters['filters'], $and);
            }
            // $stmt->order(['name' => 'ASC']);
            $instances = $stmt->run();
            if ($asobj) {
                return array_map(function ($instance) {
                    return (new DietController(
                        CaseHandler::convert($instance, 0)
                    ))->model;
                }, $instances);
            } else return $instances;
        } catch (\PDOException $e) {
            throw RequestExceptionFactory::create('Something bad happened while performing this action', 500);
        }
        return [];
    }

    /**
     * Removes this instance from the database
     */
    public function delete()
    {
        try {
            $this->get();
            $stmt = new PDOQueryBuilder($this->table);
            $stmt->delete();
            $stmt->where('id', $this->model->id);

            // By standarization, DELETE method should return an empty body either if success or not.
            return $stmt->run();
        } catch (PDOException $e) {
            throw RequestExceptionFactory::create("Something bad happened while performing this action", 500);
        }
    }

    public function search(string $query, bool $asobj = false, int $page = 1)
    {
        try {
            $fields = $this->model->getColumnNames();
            $stmt = new PDOQueryBuilder($this->table, 10, $page);
            $stmt->select($fields);
            $stmt->search([$fields], $query);
            $instances = $stmt->run();
            if ($asobj) {
                return array_map(function ($instance) {
                    $ctl = new DietController(
                        CaseHandler::convert($instance, 0)
                    );
                    return $ctl->model;
                }, $instances);
            } else return $instances;
        } catch (PDOException $e) {
            throw RequestExceptionFactory::create('Something bad happened while performing this action', 500);
        }
    }
}
