<?php

namespace Tests\Feature;

use Carbon\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */



    public function it_allows_anyone_to_see_list_all_article()
    {
        $response = $this->get(route('api/v1/books'));
        $response->assertSuccessful();
        $response->assertViewIs('.index');
        $response->assertViewHas('articles');
    }


}
