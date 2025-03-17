<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Config;

use function PHPUnit\Framework\assertEquals;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        assertEquals($firstName1, $firstName2);
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');

        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        assertEquals($firstName1, $firstName2);
        assertEquals($firstName1, $firstName3);
    }

    public function testConfigMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Odis Keren');

        $firstName = Config::get('contoh.author.first');

        assertEquals("Odis Keren", $firstName);
    }
}
