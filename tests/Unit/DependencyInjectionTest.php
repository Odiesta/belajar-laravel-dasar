<?php

namespace Tests\Unit;

use App\Data\Bar;
use App\Data\Foo;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;

class DependencyInjectionTest extends TestCase
{
    public function testDependencyInjection(): void
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        assertEquals("Foo and Bar", $bar->bar());
    }
}
