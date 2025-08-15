<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignAuthorsToBookRequest;
use App\Http\Resources\Author\AuthorsListResource;
use App\Http\Responses\ApiResponse;
use App\Models\Book;

class AssignAuthorsToBookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignAuthorsToBookRequest $request)
    {
        try{
            $data = $request->validated();

            $book = Book::query()->findOrFail($data['book_id']);

            if (is_null($book)) {
                return ApiResponse::error('Book not found');
            }

            $book->authors()->sync($data['author_ids']);

            return ApiResponse::success('Authors successfully assigned to book', AuthorsListResource::collection($book->authors));
        } catch (\Exception $e){
            return ApiResponse::serverError('Failed to assign authors to book', $e->getMessage());
        }
    }
}
