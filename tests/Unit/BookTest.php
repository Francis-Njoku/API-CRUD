<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
   //use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */


    public function test_can_create_book() {

        $data = [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->isbn10,

            'number_of_pages' => $this->faker->randomDigit,
            'publisher' => $this->faker->userName,
            'country' => $this->faker->country,
            'release_date' => $this->faker->dateTime,
        ];

        $this->post(route('books.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function a_reader_can_read_all_the_books()
    {
        // Given we have task in the database
        $book = factory('\App\Book')->create();

        // when user visit the book page
        $response = $this->get('/api/v1/books');

        // He should be able to read the book
        $response->assertSee($book);
    }

    public function it_allows_anyone_to_see_list_all_article()
    {
        $response = $this->get(route('api/v1/books'));
        $response->assertSuccessful();
        $response->assertViewIs('books.store');
        $response->assertViewHas('books');
    }

    public function test_can_show_book() {

        $post = factory(Book::class)->create();

        $this->get(route('books.show', $post->id))
            ->assertStatus(200);
    }

    public function test_can_delete_post() {

        $post = factory(Book::class)->create();

        $this->delete(route('books.delete', $post->id))
            ->assertStatus(200);
    }

    public function test_can_list_posts() {
        $posts = factory(Book::class, 2)->create()->map(function ($post) {
            return $post->only(['id', 'name', 'publisher']);
        });

        $this->get(route('book.list'))
            ->assertStatus(200)
            ->assertJson($posts->toArray())
            ->assertJsonStructure([
                '*' => [ 'id', 'name', 'publisher' ],
            ]);
    }

    public function test_can_update_post() {

        $post = factory(Book::class)->create();

        $data = [
            'name' => $this->faker->sentence,
            'isbn' => $this->faker->isbn10,

            'number_of_pages' => $this->faker->randomDigit,
            'publisher' => $this->faker->userName,
            'country' => $this->faker->country,
            'release_date' => $this->faker->dateTime,
        ];

        $this->put(route('books.update', $post->id), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }
}
