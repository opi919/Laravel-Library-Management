<?php

namespace App\Http\Controllers;

use App\Models\BookIssue;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    public function index()
    {
        // dd(BookIssue::first()->students->name);
        $data['requests'] = BookIssue::where('status', 'pending')->orderBy('id', 'desc')->get();
        return view('book-issue.index', $data);
    }

    public function edit($id)
    {
        //settings
        $setting = Settings::latest()->first();
        $issue = BookIssue::find($id);
        // calculate fine
        if ($issue->status == 'notreturned') {
            $today = Carbon::now();
            $return_date = Carbon::parse($issue->return_date);
            $diff = $return_date->diffInDays($today, false);
            // dd($diff);
            if ($diff > 0) {
                $issue->fine = $diff * $setting->fine_per_day;
            }
            $issue->save();
        }
        $data['issue'] = $issue;
        return view('book-issue.edit', $data);
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
        $data['requests'] = BookIssue::where('status', 'notreturned')->orWhere('status', 'returned')->orderBy('id', 'desc')->get();
        return view('book-issue.approved', $data);
    }

    public function rejected()
    {
        $data['requests'] = BookIssue::where('status', 'rejected')->orderBy('id', 'desc')->get();
        return view('book-issue.rejected', $data);
    }

    public function return($id)
    {
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
