<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
        $data['books'] = Book::all();
        return view('books.index', $data);
    }
    public function create(){
        $data['authors'] = Author::all();
        $data['categories'] = Category::all();
        $data['publishers'] = Publisher::all();
        return view('books.create',$data);
    }
    public function store(Request $request){
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required',
        ])->validate();
        $book = new Book();
        $book->name = $request->name;
        $book->author_id = $request->author;
        $book->category_id = $request->category;
        $book->publisher_id = $request->publisher;
        $book->stock = $request->stock;
        $book->save();
        $notification = array(
            'message' => 'Book created successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('books.index')->with($notification);
    }
    public function edit($id){
        $data['book'] = Book::find($id);
        $data['authors'] = Author::all();
        $data['categories'] = Category::all();
        $data['publishers'] = Publisher::all();
        return view('books.edit',$data);
    }
    public function update(Request $request, $id){
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required',
        ])->validate();
        $book = Book::find($id);
        $book->name = $request->name;
        $book->author_id = $request->author;
        $book->category_id = $request->category;
        $book->publisher_id = $request->publisher;
        $book->stock = $request->stock;
        $book->save();
        $notification = array(
            'message' => 'Book updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('books.index')->with($notification);
    }
    public function delete($id){
        $book = Book::find($id);
        $book->delete();
        $notification = array(
            'message' => 'Book deleted successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('books.index')->with($notification);
    }
}
