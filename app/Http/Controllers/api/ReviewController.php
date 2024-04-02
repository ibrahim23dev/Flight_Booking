<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;


class ReviewController extends Controller
{
  
    public function index(Request $request)
    {
        try {
           
            $domain = url('/'); 

            // Retrieve active reviews with user information and select specific columns
            $reviews = Review::where('reviews.status', 'active')
                ->select(
                    'reviews.rating',
                    'reviews.review_text',
                    'users.id as user_id',
                    'users.name as user_name',
                    \DB::raw('CONCAT("'.$domain.'/storage/images/users/", users.image) as user_image')
                )
                ->join('users', 'reviews.user_id', '=', 'users.id')
                ->get();

            return response()->json(['data' => $reviews], 200);
        } catch (\Exception $e) {
            // Log the error for debugging.
            \Log::error('Error in ReviewsController: ' . $e->getMessage());

            // Return a generic error response.
            return response()->json(['message' => 'An error occurred' . $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'rating' => ['required', 'integer', 'min:1', 'max:5'],
                'review_text' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
            }

            // Create and store the review
            $review = new Review();
            $review->rating = $request->input('rating');
            $review->review_text = $request->input('review_text');
            $review->status='inactive';
            $review->user_id = auth()->user()->id; 

            $review->save();

            return response()->json(['message' => 'Review created successfully and will be publish after approvel.'], 201);
        } catch (\Exception $e) {
            // Log the error for debugging.
            \Log::error('Error in ReviewsController: ' . $e->getMessage());

            // Return a generic error response.
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

}
    
