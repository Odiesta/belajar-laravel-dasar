<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;
use function PHPUnit\Framework\assertSame;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;

class ServiceContainerTest extends TestCase
{
    public function testCreateDependency(): void
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        assertEquals("Foo", $foo->foo());
        assertEquals("Foo", $foo2->foo());
        assertNotSame($foo, $foo2);
    }

    public function testBind(): void
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Odiesta", "Shandikarona");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        assertEquals("Odiesta", $person->firstName);
        assertEquals("Odiesta", $person2->firstName);
        assertNotSame($person, $person2);
    }

    public function testSingleton(): void
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Odiesta", "Shandikarona");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        assertEquals("Odiesta", $person->firstName);
        assertEquals("Odiesta", $person2->firstName);
        assertSame($person, $person2);
    }

    public function testInstance(): void
    {
        $person = new Person("Odiesta", "Shandikarona");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        assertEquals("Odiesta", $person1->firstName);
        assertEquals("Odiesta", $person2->firstName);
        assertSame($person, $person1);
        assertSame($person1, $person2);
    }

    public function testDependencyInjection(): void
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        assertEquals("Foo and Bar", $bar->bar());
        assertSame($foo, $bar->foo);
    }

    public function testDependencyInjectionInClosure(): void
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        assertSame($bar1, $bar2);
    }

    public function testHelloService()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        assertEquals("Halo Odiesta", $helloService->hello("Odiesta"));
    }
}
