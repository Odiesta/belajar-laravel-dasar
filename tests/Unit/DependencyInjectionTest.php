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

    public function testCreateDependency(): void
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        assertEquals("Foo", $foo->foo());
        assertEquals("Foo", $foo2->foo());
        assertNotSame($foo, $foo2);
    }
}
