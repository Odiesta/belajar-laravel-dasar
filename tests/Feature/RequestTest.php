<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RequestTest extends TestCase
{
    public function testRequest(): void
    {
        $this->get('/controller/hello/request', [
            'Accept' => 'plain/text'
        ])->assertSeeText('controller/hello/request')
            ->assertSeeText('http://localhost/controller/hello/request')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text');
    }

    public function testInput(): void
    {
        $this->get('/input/hello?name=Odis')->assertSeeText('Hello Odis');
        $this->post('/input/hello', ['name' => 'Odis'])->assertSeeText('Hello Odis');
    }
}
