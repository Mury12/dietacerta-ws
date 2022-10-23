<?php

namespace MMWS\Response;

class Jwt
{
    public string $jwt;
    public ?string $name;

    function __construct(string $jwt, string $name = null)
    {
        $this->jwt = $jwt;
        $this->name = $name;
    }
}
