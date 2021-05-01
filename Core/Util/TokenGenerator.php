<?php
namespace Core\Util;

class TokenGenerator{

    /**
     * @return string $hash
     */
    public function generateToken(int $length) : int
    {
        return random_bytes($length);
    }
}