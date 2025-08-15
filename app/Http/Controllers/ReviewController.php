<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\CreateReviewRequest;
use App\Http\Resources\Review\ReviewDetailResource;
use App\Http\Resources\Review\ReviewsListResource;
use App\Http\Responses\ApiResponse;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function allReviews(Request $request)
    {
        try{
            $reviews = Review::query()->paginate();

            return ReviewsListResource::collection($reviews);
        }catch (\Exception $e){
            return ApiResponse::serverError('Something went wrong', $e->getMessage());
        }
    }
    public function createReview(CreateReviewRequest $request)
    {
        try{
            $user = $request->user();

            $data = $request->validated();

            $review = Review::query()->where("user_id", $user->id)->where('book_id', $data['book_id'])->first();

            if(! is_null($review)){
                return ApiResponse::error('Review already exists');
            }

            $review = Review::query()->create([
                'user_id' => $user->id,
                'book_id' => $data['book_id'],
                'comment' => $data['comment'],
                'score' => $data['score'],
            ]);

            return ApiResponse::success('Review created successfully.', new ReviewDetailResource($review));

        } catch (\Exception $e) {
            return ApiResponse::serverError('Something went wrong', $e->getMessage());
        }
    }

    public function deleteReview(Request $request, $review_id)
    {
        try{
            $review = Review::query()->find($review_id);

            if (is_null($review)){
                return ApiResponse::error('Review not found');
            }

            $review->delete();

            return ApiResponse::success('Review deleted successfully.');
        } catch (\Exception $e){
            return ApiResponse::serverError('Something went wrong', $e->getMessage());
        }
    }
}
