<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookIssue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserBookReqController extends Controller
{
    public function index()
    {
        $data['requests'] = BookIssue::where('user_id', auth()->user()->id)->orderBy('issue_date','asc')->get();
        return view('user-book-req.index', $data);
    }

    public function create(){
        $data['books'] = Book::where('stock', '>', 0)->get();
        return view('user-book-req.create', $data);
    }

    public function store(Request $request, $user_id)
    {
        //check valid user
        $user = User::find($user_id);
        if ($user->status != 1) {
            $nofication = array(
                'message' => 'Your account is not active yet!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($nofication);
        }
        $issue = BookIssue::where('user_id', $user_id)->where('book_id', $request->book)
            ->where('status', '!=', 'notreturned')->first();
        $count_maximum_issue = BookIssue::where('user_id', $user_id)
            ->whereBetween('status', ['notreturned', 'pending'])->count();
        //check if user request for more than 3 books
        if ($count_maximum_issue >= 3) {
            $nofication = array(
                'message' => 'You have already issued 3 books',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($nofication);
        }
        //check if user has already issued the book
        if ($issue) {
            $nofication = [
                'message' => 'Already you have requested this book',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($nofication);
        }
        // validation
        Validator::make($request->all(), [
            'book' => 'required',
        ])->validate();
        $book_id = $request->book;
        $quantity = 1;
        $book = Book::find($book_id);
        if ($book->stock < $quantity) {
            $nofication = [
                'message' => 'Book out of stock',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($nofication);
        }
        $book->stock = $book->stock - $quantity;
        $book->save();
        $book_issue = new BookIssue();
        $book_issue->user_id = $user_id;
        $book_issue->book_id = $book_id;
        $book_issue->issue_date = date('Y-m-d');
        $book_issue->return_date = date('Y-m-d', strtotime('+7 days'));
        $book_issue->save();
        $nofication = [
            'message' => 'Your request is waiting for approval',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($nofication);
    }
}
