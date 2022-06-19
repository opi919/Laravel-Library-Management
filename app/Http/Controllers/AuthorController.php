<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $data['authors'] = Author::all();
        return view('authors.index', $data);
    }
    public function create()
    {
        return view('authors.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $author = new Author();
        $author->name = $request->name;
        $author->save();
        $notification = array(
            'message' => 'Author created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('authors.index')->with($notification);
    }
    public function edit($id)
    {
        $data['author'] = Author::find($id);
        return view('authors.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $author = Author::find($id);
        $author->name = $request->name;
        $author->save();
        $notification = array(
            'message' => 'Author updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('authors.index')->with($notification);
    }
    public function delete($id)
    {
        $author = Author::find($id);
        $author->delete();
        $notification = array(
            'message' => 'Author deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('authors.index')->with($notification);
    }
}
