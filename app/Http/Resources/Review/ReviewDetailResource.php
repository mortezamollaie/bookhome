<?php

namespace App\Http\Resources\Review;

use App\Http\Resources\Book\BookDetailResource;
use App\Http\Resources\User\UserDetailResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => new UserDetailResource($this->user),
            'book' => new BookDetailResource($this->book),
            'comment' => $this->comment,
            'score' => $this->score
        ];
    }
}
