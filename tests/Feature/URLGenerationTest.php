<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testURLCurrent()
    {
        $this->get('/url/current?name=Odis')
            ->assertSeeText('/url/current?name=Odis');
    }

    public function testNamed()
    {
        $this->get('/url/named')
            ->assertSeeText('/redirect/name/Odis');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
