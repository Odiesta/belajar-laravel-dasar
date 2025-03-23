<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EncryptionTest extends TestCase
{
    public function testEncrypt()
    {
        $encrypt = Crypt::encrypt('Odiesta Shandikarona');
        $decrypt = Crypt::decrypt($encrypt);

        assertEquals('Odiesta Shandikarona', $decrypt);
    }
}
