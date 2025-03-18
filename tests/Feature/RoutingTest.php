<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get("/pzn")
            ->assertStatus(200)
            ->assertSeeText("Hello Programmer Zaman Now");
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/404')
            ->assertSeeText('404 by Programmer Zaman Now');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Products : 1');

        $this->get('/products/2')
            ->assertSeeText('Products : 2');

        $this->get('/products/1/items/xxx')
            ->assertSeeText('Products : 1, Items : xxx');

        $this->get('/products/2/items/yyy')
            ->assertSeeText('Products : 2, Items : yyy');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/1234567890')
            ->assertSeeText('Categories : 1234567890');

        $this->get('/categories/salah')
            ->assertSeeText('404 by Programmer Zaman Now');
    }

    public function testRouteOptionalParameter()
    {
        $this->get('/users/12345')
            ->assertSeeText('Users : 12345');

        $this->get('/users/')
            ->assertSeeText('Users : 404');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/odoy')
            ->assertSeeText('Conflict odoy');

        $this->get('/conflict/odis')
            ->assertSeeText('Conflict odis ganteng');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/1')
            ->assertSeeText('Link http://localhost/products/1');

        $this->get('/product-redirect/2')
            ->assertRedirect('products/2');
    }
}
