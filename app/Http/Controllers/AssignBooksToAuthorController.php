<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignBooksToAuthorRequest;
use App\Http\Resources\Book\BooksListResource;
use App\Http\Responses\ApiResponse;
use App\Models\Author;
use Illuminate\Http\Request;

class AssignBooksToAuthorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignBooksToAuthorRequest $request)
    {
        try{
            $data = $request->validated();

            $author = Author::query()->findOrFail($data['author_id']);

            if (is_null($author)) {
                return ApiResponse::error('Author not found');
            }

            $author->books()->sync($data['book_ids']);

            return ApiResponse::success('Book successfully assigned to author', BooksListResource::collection($author->books));
        } catch (\Exception $e){
            return ApiResponse::serverError('Failed to create author', $e->getMessage());
        }
    }
}
