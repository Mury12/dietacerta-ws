<?php

namespace MMWS\Response;

class Jwt
{
    public string $jwt;

    function __construct(string $jwt)
    {
        $this->jwt = $jwt;
    }
}
