<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    /**
     * Test string reversal functionality.
     */
    public function test_string_can_be_reversed(): void
    {
        $original = 'Hello World';
        $reversed = strrev($original);

        $this->assertEquals('dlroW olleH', $reversed);
    }

    /**
     * Test string uppercase conversion.
     */
    public function test_string_can_be_uppercased(): void
    {
        $original = 'hello world';
        $uppercased = strtoupper($original);

        $this->assertEquals('HELLO WORLD', $uppercased);
    }
}
