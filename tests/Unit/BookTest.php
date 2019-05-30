<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    public function testCreateBook()
    {
        $data = [
            'name' => "Get it Done",
            'isbn' => '134253213',
            'country' => "Germany",
            'number_of_pages' => '250',
            'publisher' => "Books and Leads",
            'release_date' => "1990/12/12",
            'authors' => "Luke, Peter",
        ];
        $response = $this->json('POST', '/api/v1/books', $data);
        $response->assertStatus(201);
        $response->assertJson(['status_code' => 201]);
        $response->assertJson(['status' => "success"]);
        $response->assertJson(['data' => [
                'book' => $data
            ]
        ]);
    }

    public function testGettingAllBooks()
    {
        $response = $this->json('GET', '/api/v1/books');
        $response->assertStatus(200);
        $response->assertJson(['status_code' => 200]);
    }

    public function testUpdateBook()
    {
        $response = $this->json('GET', '/api/v1/books');
        $response->assertStatus(200);

        $book = $response->getData()->data[0];

        $update = $this->json('PATCH', '/api/v1/books/'.$book->id, ['name' => "Changed name of Book"]);

        $update->assertStatus(200);
        $update->assertJson(['status_code' => 200]);
        $update->assertJson(['status' => "success"]);
    }

    public function testDeleteBook()
    {
        $response = $this->json('GET', '/api/v1/books');
        $response->assertStatus(200);

        $book = $response->getData()->data[0];

        $delete = $this->json('DELETE', '/api/v1/books/'.$book->id);
        $delete->assertStatus(200);
        $delete->assertJson(['status_code' => 200]);
        $delete->assertJson(['status' => "success"]);
        $delete->assertJson(['message' => "The book $book->name was deleted successfully"]);
    }
}
