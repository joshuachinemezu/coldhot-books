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

        $authors = [];
        foreach ($books as  $book) {
            $writers = explode(',', $book->authors);
            $book->authors = $writers;
        }


        return JSON(CODE_SUCCESS, $books, "Sale Created Successfully");
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

        return JSON(CODE_CREATE_SUCCESS, $book);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $books = Book::all();

        return JSON(CODE_SUCCESS, $books, "Sale Created Successfully");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find or fail, Exceptions handler has been configured to handle 404 errors in an elegant manner
        $book = Book::findorfail($id);

        $book->name = $request->name;
        $book->isbn = $request->isbn;
        $book->authors = $request->authors;
        $book->country = $request->country;
        $book->number_of_pages = $request->number_of_pages;
        $book->publisher = $request->publisher;
        $book->release_date = $request->release_date;
        $book->save();

        return JSON(CODE_SUCCESS, $book, "The book $book->name was updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find or fail, Exceptions handler has been configured to handle 404 errors in an elegant manner
        $book = Book::findorfail($id);

        $book->delete();

        return JSON(CODE_REMOVE_SUCCESS, [], "The book $book->name was deleted successfully");
    }
}
