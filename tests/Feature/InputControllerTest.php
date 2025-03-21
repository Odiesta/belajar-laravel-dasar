<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput(): void
    {
        $this->get('/input/hello?name=Odis')->assertSeeText('Hello Odis');
        $this->post('/input/hello', ['name' => 'Odis'])->assertSeeText('Hello Odis');
    }

    public function testNestedInput(): void
    {
        $this->post('/input/hello/first', ['name' => [
            'first' => 'Odis'
        ]])->assertSeeText('Hello Odis');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Odiesta',
                'last' => 'Shandikarona'
            ]
        ])->assertSeeText("name")->assertSeeText("first")->assertSeeText("Odiesta")
            ->assertSeeText("last")->assertSeeText("Shandikarona");
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' => [
                ['name' => 'Apple Mac Book Pro'],
                ['name' => 'Samsung Galaxy S']
            ]
        ])->assertSeeText('Apple Mac Book Pro')->assertSeeText('Samsung Galaxy S');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Odoy',
            'married' => 'false',
            'birth_date' => '2000-12-12'
        ])->assertSeeText('Odoy')->assertSeeText('false')->assertSeeText('2000-12-12');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Odiesta",
                "middle" => "Ganteng",
                "last" => "Shandikarona"
            ]
        ])->assertSeeText("Odiesta")->assertSeeText("Shandikarona")->assertDontSeeText("Ganteng");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Odiesta",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("Odiesta")->assertSeeText("rahasia")->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Odiesta",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("Odiesta")->assertSeeText("rahasia")->assertSeeText("admin")->assertSeeText("false");
    }
}
