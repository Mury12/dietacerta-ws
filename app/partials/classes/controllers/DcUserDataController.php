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
use MMWS\Model\DcUserData;

class DcUserDataController
{
    
    public $model;

    public function __construct(DcUserData $model)
    {
        $this->model = new DcUserData($model);
    }

    /**
     * Saves this instance to the database
     */
    public function save()
    {
        return $this->model->save();
    }

    /**
     * Updates this instance to the database
     */
    public function update()
    {
        return $this->model->update();
    }

    /**
     * Get one instance from the database
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * Get all the instances from the database and returns 
     * as an SELF::CLASS array
     */
    public function getAll()
    {
        return $this->model->getAll();
    }

    /**
     * Removes this instance from the database
     */
    public function delete()
    {
        return $this->model->delete();
    }
}