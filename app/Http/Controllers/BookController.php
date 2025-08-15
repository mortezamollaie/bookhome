<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\BookStoreRequest;
use App\Http\Requests\Books\BookUpdateRequest;
use App\Http\Resources\Book\BookDetailResource;
use App\Http\Resources\Book\BooksListResource;
use App\Http\Responses\ApiResponse;
use App\Models\Book;
use Illuminate\Support\Str;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(15);
        return BooksListResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['slug'] = Str::slug($validated['title']);

            $book = Book::create($validated);

            return ApiResponse::created('Book created successfully', new BookDetailResource($book));
        } catch (\Exception $e) {
            return ApiResponse::serverError('Failed to create book', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $book = Book::findOrFail($id);
            return ApiResponse::success('Book retrieved successfully', new BookDetailResource($book));
        } catch (\Exception $e) {
            return ApiResponse::notFound('Book not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, string $id)
    {
        try {
            $book = Book::findOrFail($id);

            $validated = $request->validated();

            if (isset($validated['title'])) {
                $validated['slug'] = Str::slug($validated['title']);
            }

            $book->update($validated);

            return ApiResponse::success('Book updated successfully', new BookDetailResource($book));
        } catch (\Exception $e) {
            return ApiResponse::notFound('Book not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();

            return ApiResponse::success('Book deleted successfully');
        } catch (\Exception $e) {
            return ApiResponse::notFound('Book not found');
        }
    }
}
