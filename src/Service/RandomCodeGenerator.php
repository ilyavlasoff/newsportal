<?php

namespace App\Service;

class RandomCodeGenerator
{
    public function GetRandomCode(int $length): string
    {
        $hexValue = random_bytes($length);
        return bin2hex($hexValue);
    }
}