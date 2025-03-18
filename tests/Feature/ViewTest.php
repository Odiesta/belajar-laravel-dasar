<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Odis');

        $this->get('/hello-again')
            ->assertSeeText('Hello Odis');
    }

    public function testViewNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Odis');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Odis'])
            ->assertSeeText('Hello Odis');

        $this->view('hello.world', ['name' => 'Odis'])
            ->assertSeeText('World Odis');
    }
}
