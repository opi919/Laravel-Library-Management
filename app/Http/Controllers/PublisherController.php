<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $data['publishers'] = Publisher::all();
        return view('publishers.index', $data);
    }
    public function create()
    {
        if (auth()->user()->role != 'admin') {
            $nofication = [
                'message' => 'You are not authorized to perform this action',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($nofication);
        } else {
            return view('publishers.create');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:publishers|max:255',
        ]);
        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->save();
        $notification = array(
            'message' => 'Publisher created successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('publishers.index')->with($notification);
    }
    public function edit($id)
    {
        $data['publisher'] = Publisher::find($id);
        return view('publishers.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:publishers|max:255',
        ]);
        $publisher = Publisher::find($id);
        $publisher->name = $request->name;
        $publisher->save();
        $notification = array(
            'message' => 'Publisher updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('publishers.index')->with($notification);
    }
    public function delete($id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();
        $notification = array(
            'message' => 'Publisher deleted successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('publishers.index')->with($notification);
    }
}
