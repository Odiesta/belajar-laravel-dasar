<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
        $image = UploadedFile::fake()->image("odis.jpg");

        $this->post('/file/upload', [
            'picture' => $image
        ])->assertSeeText("OK : odis.jpg");
    }
}
