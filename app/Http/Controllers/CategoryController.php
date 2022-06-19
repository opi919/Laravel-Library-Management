<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::all();
        return view('categories.index',$data);
    }
    public function create(){
        if (auth()->user()->role != 'admin') {
            $nofication = [
                'message' => 'You are not authorized to perform this action',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($nofication);
        }
        else{
            return view('categories.create');
        }
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        $notification = array(
            'message' => 'Category created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('categories.index')->with($notification);
    }
    public function edit($id){
        $data['category'] = Category::find($id);
        return view('categories.edit',$data);
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        $notification = array(
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('categories.index')->with($notification);
    }
    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        $notification = array(
            'message' => 'Category deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('categories.index')->with($notification);
    }
}
