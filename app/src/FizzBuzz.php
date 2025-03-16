<?php

namespace App;

class FizzBuzz
{
    public static function run(int $i): ?string
    {
        if (1 > $i || $i > 100) return null;

        if ($i % 3 == 0 && $i % 5 == 0) {
            return "FizzBuzz";
        }
        else if ($i % 3 == 0) {
            return "Fizz";
        }
        else if ($i % 5 == 0) {
            return "Buzz";
        }
        else return (string) $i;
    }
}