<?php

namespace App\Http\Controllers;

use App\Http\Resources\Author\AuthorDetailResource;
use App\Http\Requests\Author\AuthorStoreRequest;
use App\Http\Requests\Author\AuthorUpdateRequest;
use App\Models\Author;
use App\Http\Resources\Author\AuthorsListResource;
use App\Http\Responses\ApiResponse;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::paginate(15);
        return AuthorsListResource::collection($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request)
    {
        try{
            $data = $request->validated();

            $existingAuthor = Author::where('first_name', $data['first_name'])->where('last_name', $data['last_name'])->first();

            if ($existingAuthor){
                return ApiResponse::error('Author with this first_name and last_name already exists.');
            }

            $newAuthor = Author::create($data);

            return ApiResponse::created('Author created successfully', new AuthorDetailResource($newAuthor));
        } catch (\Exception $e) {
            return ApiResponse::serverError('Failed to create author', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $author = Author::findOrFail($id);

            return ApiResponse::success('Author retrieved successfully', new AuthorDetailResource($author));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResponse::error('Author not found', 404);
        } catch (\Exception $e) {
            return ApiResponse::serverError('Failed to retrieve author', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorUpdateRequest $request, string $id)
    {
        try{
            $author = Author::findOrFail($id);

            $data = $request->validated();

            $author->update($data);

            return ApiResponse::success('Author updated successfully', new AuthorDetailResource($author));
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResponse::error('Author not found', 404);
        } catch (\Exception $e) {
            return ApiResponse::serverError('Failed to update author', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->delete();

            return ApiResponse::success('Author deleted successfully');
        } catch (\Exception $e) {
            return ApiResponse::notFound('Author not found');
        }
    }


}
