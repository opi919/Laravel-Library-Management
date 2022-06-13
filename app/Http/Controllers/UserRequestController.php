<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function index()
    {
        $data['requests'] = User::where('role', 'librarian')->whereBetween('status', [-1, 1])->get();
        return view('user-requests.index', $data);
    }
    public function approve($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return redirect()->route('user-requests.index');
    }
    public function reject($id)
    {
        $user = User::find($id);
        $user->status = -1;
        $user->save();
        return redirect()->route('user-requests.index');
    }
}
