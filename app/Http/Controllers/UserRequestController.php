<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function index()
    {
        $data['requests'] = User::where('role', 'librarian')->whereBetween('status',[-1,1])->orderBy('id', 'desc')->get();
        return view('user-requests.index', $data);
    }
    public function approve($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        $notification = array(
            'message' => 'Request approved!',
            'alert-type' => 'success'
        );
        return redirect()->route('user-requests.index')->with($notification);
    }
    public function reject($id)
    {
        $user = User::find($id);
        $user->status = -1;
        $user->save();
        $notification = array(
            'message' => 'Request rejected!',
            'alert-type' => 'error'
        );
        return redirect()->route('user-requests.index')->with($notification);
    }

    public function approved()
    {
        $data['requests'] = User::where('role', 'librarian')->where('status',1)->orderBy('id', 'desc')->get();
        return view('user-requests.approved', $data);
    }
    public function rejected()
    {
        $data['requests'] = User::where('role', 'librarian')->where('status',-1)->orderBy('id', 'desc')->get();
        return view('user-requests.rejected', $data);
    }
}
