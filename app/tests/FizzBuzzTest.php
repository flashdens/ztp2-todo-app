<?php
/**
 * Example test.
 */

namespace App\Tests;

use App\FizzBuzz;
use PHPUnit\Framework\TestCase;

/**
 * Class ExampleTest.
 */
class FizzBuzzTest extends TestCase
{
    /**
     * Test Example.
     */
    public function testExample()
    {
        $fizzBuzz = new FizzBuzz();
        $this->assertEquals($fizzBuzz->run(1), "1");
        $this->assertEquals($fizzBuzz->run(4), "4");

        $this->assertEquals($fizzBuzz->run(0), null);
        $this->assertEquals($fizzBuzz->run(-1), null);
        $this->assertEquals($fizzBuzz->run(101), null);

        $this->assertEquals($fizzBuzz->run(3), "Fizz");
        $this->assertEquals($fizzBuzz->run(6), "Fizz");

        $this->assertEquals($fizzBuzz->run(5), "Buzz");
        $this->assertEquals($fizzBuzz->run(10), "Buzz");

        $this->assertEquals($fizzBuzz->run(15), "FizzBuzz");
        $this->assertEquals($fizzBuzz->run(30), "FizzBuzz");

    }
}
