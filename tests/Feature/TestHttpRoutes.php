<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestHttpRoutes extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFoobarGet()
    {
        $response = $this->get('/foobar');
        $response->assertStatus(200);
    }

    public function testFoobarPost()
    {
        $response = $this->post('/foobar');
        $response->assertStatus(200);
    }

    public function testFoomarGet()   {
        $response = $this->get('/foomar');
        $response->assertStatus(200);
    }
    public function testFoomarPut()   {
        $response = $this->put('/foomar');
        $response->assertStatus(200);
    }
    public function testFoomarPatch()   {
        $response = $this->patch('/foomar');
        $response->assertStatus(200);
    }
 

}
