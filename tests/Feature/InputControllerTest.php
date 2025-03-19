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
}
