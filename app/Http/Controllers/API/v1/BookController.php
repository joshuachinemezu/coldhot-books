<?php

namespace App\Http\Controllers\API\v1;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        foreach ($books as  $book) {
            $writers = explode(',', $book->authors);
            $book->authors = $writers;
        }


        return JSON(CODE_SUCCESS, $books);
    }

    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string',
            'isbn' => 'required|string',
            'authors' => 'required|string|distinct',
            'country' => 'required|string',
            'number_of_pages' => 'required|string',
            'publisher' => 'required|string',
            'release_date' => 'required|string',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'isbn', 'authors', 'country', 'number_of_pages', 'publisher', 'release_date');

        // Validate request
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return JSON(CODE_VALIDATION_ERROR, ['errors' => $validator->errors()]);
        }

        // Initiate a book creation transaction
        try {
            $book = Book::create($request->only('name', 'isbn', 'authors', 'country', 'number_of_pages', 'publisher', 'release_date'));
        } catch (\Exception $e) {
            // Catch error and return
            return JSON(CODE_BAD_REQUEST, ['errors' => $e]);
        }

        return JSON(CODE_CREATE_SUCCESS, ['book' => $book]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($search)
    {
        $books = Book::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('country', 'LIKE', "%{$search}%")
            ->orWhere('publisher', 'LIKE', "%{$search}%")
            ->orWhere('release_date', 'LIKE', "%{$search}%")
            ->get();
   
        return JSON(CODE_SUCCESS, $books);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->update(
            $request->only(['name', 'isbn', 'authors', 'country', 'number_of_pages', 'publisher', 'release_date'])
        );

        return JSON(CODE_SUCCESS, $book, "The book $book->name was updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return JSON(CODE_REMOVE_SUCCESS, [], "The book $book->name was deleted successfully");
    }
}
