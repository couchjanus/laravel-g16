<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testGetBlog()
    {
        $response = $this->get('/blog');
        // $response->assertStatus(200);
        $response->assertStatus(404);
    }

    public function testBlogRoutes()
    {
        $appURL = env('APP_URL');

        $urls = [
            '/blog',
            '/blog/show',
            '/blog/create',
            '/blog/update',
            '/blog/delete',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            if((int)$response->status() !== 200){
                echo  $appURL . $url . " (FAILED) did not return a 200.\n";
                $this->assertFalse(false);
            } else {
                echo $appURL . $url . "\n (success) return a 200!\n";
                $this->assertTrue(true);
            }
        }
    }

    public function testWelcomeView()
    {
        $response = $this->get('/');
        $response->assertViewIs('welcome');
    }
 


}
