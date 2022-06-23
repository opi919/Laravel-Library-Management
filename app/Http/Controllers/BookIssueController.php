<?php

namespace App\Http\Controllers;

use App\Models\BookIssue;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    public function index()
    {
        // dd(BookIssue::first()->students->name);
        $data['requests'] = BookIssue::where('status','pending')->orderBy('id','desc')->get();
        return view('book-issue.index',$data);
    }

    public function edit($id){
        $data['issue'] = BookIssue::find($id);
        return view('book-issue.edit',$data);
    }

    public function approve($id)
    {
        $issue = BookIssue::find($id);
        $issue->status = 'notreturned';
        $issue->save();
        $notification = array(
            'message' => 'Request approved!',
            'alert-type' => 'success'
        );
        return redirect()->route('book-issue.index')->with($notification);
    }
    public function reject($id)
    {
        $issue = BookIssue::find($id);
        $issue->status = 'rejected';
        $issue->save();
        $notification = array(
            'message' => 'Request rejected!',
            'alert-type' => 'error'
        );
        return redirect()->route('book-issue.index')->with($notification);
    }

    public function approved()
    {
        $data['requests'] = BookIssue::where('status','notreturned')->orWhere('status','returned')->orderBy('id','desc')->get();
        return view('book-issue.approved',$data);
    }

    public function rejected()
    {
        $data['requests'] = BookIssue::where('status','rejected')->orderBy('id','desc')->get();
        return view('book-issue.rejected',$data);
    }

    public function return($id){
        $issue = BookIssue::find($id);
        $issue->status = 'returned';
        $issue->save();

        $notification = array(
            'message' => 'Book Returned successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('book-issue.approved')->with($notification);
    }
}
