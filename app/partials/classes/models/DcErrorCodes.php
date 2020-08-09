<?php
/**
 * This file was automatically generated by the Awesome Conflex Webservice Model Generator Module
 * based in MYSQL/Mariadb database tables. After the generation you can modify
 * this model to fill with the best methods you think it should have.
 * 
 * 
 * Take care of this template and abuse of this.
 * 
 * Thank you for using it. github.com/mury12
 * 
 */
 
namespace MMWS\Model;
use MMWS\Entity\DcErrorCodesEntity;

class DcErrorCodes
{

    /**
     * @var String $table the table name for this model;
     */   
    public $table = 'dc_error_codes';


    /**
     * @var MMWS\Entity\DcErrorCodesEntity $entity the entity for this model
     */
    public $entity;

    public $id;
    public $description;
    public $typeid;
    

    public function __construct($id = null, $description = null, $typeid = null)
    {
        $this->id = $id;
	    $this->description = $description;
	    $this->typeid = $typeid;
	    
        $this->entity = new DcErrorCodesEntity($this);
    }

    /**
     * Saves this instance to the database
     */
    public function save()
    {
        return $this->entity->save();
    }

    /**
     * Updates this instance to the database
     */
    public function update()
    {
        return $this->entity->update();
    }

    /**
     * Get one instance from the database
     */
    public function get()
    {
        return $this->entity->get();
    }

    /**
     * Get all the instances from the database and returns 
     * as an SELF::CLASS array
     */
    public function getAll()
    {
        return $this->entity->getAll();
    }

    /**
     * Removes this instance from the database
     */
    public function delete()
    {
        return $this->entity->delete();
    }
}