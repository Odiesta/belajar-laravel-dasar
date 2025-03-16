<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $first = config('contoh.author.first');
        $last = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        assertEquals('Odiesta', $first);
        assertEquals('Shandikarona', $last);
        assertEquals('shandikaronamade@gmail.com', $email);
        assertEquals('https://www.odiestas.com', $web);
    }
}
