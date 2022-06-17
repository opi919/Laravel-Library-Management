<?php

namespace App\Http\Controllers;

use App\Models\BookIssue;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    public function index()
    {
        // dd(BookIssue::first()->students->name);
        $data['requests'] = BookIssue::orderBy('id','desc')->get();
        return view('book-issue.index',$data);
    }

    public function approve($id)
    {
        $issue = BookIssue::find($id);
        $issue->status = 'approved';
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
}
