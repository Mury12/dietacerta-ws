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

use MMWS\Interfaces\AbstractModel;

class User extends AbstractModel
{
    protected ?int $id;
    protected ?string $name;
    protected ?string $email;
    protected ?string $password;
    protected ?int $act;


    public function __construct($id = null, $name = null, $email = null, $password = null, $act = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->act = $act;
        $this->setHiddenFields(['password', 'id', 'act']);
    }

    public function encryptPassword()
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function matchPassword(string $raw)
    {
        return password_verify($raw, $this->password);
    }
}
