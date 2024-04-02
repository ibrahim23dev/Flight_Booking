<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
class ReviewController extends Controller
{
    public function index(){
        $reviews=Review::with('user')->get();
        return view('backend/general/reviews/index',compact('reviews'));

    }

    public function create(){
        $users=User::all();
        return view('backend/general/reviews/create',compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'review_text' => ['required', 'string'],
            'rating' => ['required', 'integer'],
            'status' => ['required', 'in:active,inactive'],
        ]);
        Review::create($validatedData);

        return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
    }
    public function edit($id){
        $review=Review::findOrfail($id);
        $users=User::all();
        return view('backend/general/reviews/update',compact('review','users'));

    }
    public function update(Request $request,$id){
        $update=Review::findOrfail($id);
        $validatedData = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'review_text' => ['required', 'string'],
            'rating' => ['required', 'integer'],
            'status' => ['required', 'in:active,inactive'],
        ]);
        $update->update($validatedData);
        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }
    public function destroy($id){
        $delete=Review::findOrfail($id);
        $delete->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
