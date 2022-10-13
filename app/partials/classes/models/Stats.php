<?php

namespace MMWS\Model;

use MMWS\Interfaces\AbstractModel;

class Stats extends AbstractModel
{
    protected float $carb;
    protected float $prot;
    protected float $tfat;
    protected float $calories;
    protected float $fibers;
    protected float $sodium;

    function __construct(float $carb, float $prot, float $tfat, float $calories, float $fibers, float $sodium)
    {
        $this->carb = $carb;
        $this->prot = $prot;
        $this->tfat = $tfat;
        $this->calories = $calories;
        $this->fibers = $fibers;
        $this->sodium = $sodium;
    }
}
