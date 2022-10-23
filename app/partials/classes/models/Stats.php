<?php

namespace MMWS\Model;

use MMWS\Interfaces\AbstractModel;

class Stats extends AbstractModel
{
    public float $carb;
    public float $prot;
    public float $tfat;
    public float $calories;
    public float $fiber;
    public float $sodium;

    function __construct(float $carb, float $prot, float $tfat, float $calories, float $fiber, float $sodium)
    {
        $this->carb = $carb;
        $this->prot = $prot;
        $this->tfat = $tfat;
        $this->calories = $calories;
        $this->fiber = $fiber;
        $this->sodium = $sodium;
    }

    /**
     * Return its properties as an indexed array, being:
     * 
     * ```php
     * 
     * [
     *      0 => carb,
     *      1 => prot,
     *      2 => tfat,
     *      3 => calories,
     *      4 => fiber,
     *      5 => sodium
     * ];
     * 
     * ```
     * 
     */
    function eachAsArray()
    {
        return [
            $this->carb,
            $this->prot,
            $this->tfat,
            $this->calories,
            $this->fiber,
            $this->sodium,
        ];
    }
}
