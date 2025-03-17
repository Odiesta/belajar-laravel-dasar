<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;
use function PHPUnit\Framework\assertSame;

class ServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        assertSame($foo, $bar->foo);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        assertSame($bar1, $bar2);
    }

    public function testProperty()
    {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        assertSame($helloService1, $helloService2);
        assertEquals('Halo Odis', $helloService1->hello('Odis'));
    }
}
