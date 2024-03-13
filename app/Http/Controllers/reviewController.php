<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class reviewController extends Controller
{
    public function review()
    {
        $user = Comment::all();
        // $selectedNumbers = [];
        return view('backend.review.review', compact('user'));
    }
    public function approvereview($id)
    {
        try {
            $review = Comment::findOrFail($id);
            $review->status = 1;
            $review->update();
            return redirect()->back()->with('success', 'Review approved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error approving review');
        }
    }

    public function deletereview($id)
    {
        Comment::where('id', $id)->delete();
        return redirect()->back()->with('success', 'review deleted successfully');
    }
}
